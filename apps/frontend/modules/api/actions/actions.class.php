<?php

/**
 * api actions.
 *
 * @package    kvarteret_events
 * @subpackage api
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeGetArrangers(sfWebRequest $request) {
    $limit = intval($request->getParameter('limit', 20));
    $offset = 0;
    if ($limit > 0) {
      $offset = intval($request->getParameter('offset', 0));
    }

    $q = Doctrine_Core::getTable('arranger')
      ->createQuery('a')
      ->select('a.name, a.id')
      ->limit($limit)
      ->offset($offset)
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    $arrangers = $q->execute();

    $this->forward404Unless($arrangers);

    $totalCount = $q->count();
    $count = count($arrangers);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $arrangers,
    );

    return $this->returnJson($data);
  }

  public function executeGetCategories (sfWebRequest $request) {
    $limit = intval($request->getParameter('limit', 20));
    $offset = 0;
    if ($limit > 0) {
      $offset = intval($request->getParameter('offset', 0));
    }

    $q = Doctrine_Core::getTable('category')
      ->createQuery('c')
      ->select('c.name, c.id')
      ->limit($limit)
      ->offset($offset)
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    $categories = $q->execute();
    
    $this->forward404Unless($categories);

    $totalCount = $q->count();
    $count = count($categories);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $categories,
    );

    return $this->returnJson($data);
  }

  public function executeGetLocations (sfWebRequest $request) {
    $limit = intval($request->getParameter('limit', 20));
    $offset = 0;
    if ($limit > 0) {
      $offset = intval($request->getParameter('offset', 0));
    }

    $q = Doctrine_Core::getTable('location')
      ->createQuery('l')
      //->select('l.name, l.id')
      ->where('l.root_id = ?', 1)
      ->limit($limit)
      ->offset($offset)
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY_HIERARCHY);

    $locations = $q->execute();

    $this->forward404Unless($locations);

    $totalCount = $q->count();
    $count = count($locations);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $locations,
    );

    return $this->returnJson($data);
  }

  public function executeGetUpcomingEvents (sfWebRequest $request) {
    // This action can accept the parameters limit and offset

    $limit = intval($request->getParameter('limit', 20));
    $offset = 0;
    if ($limit > 0) {
      $offset = intval($request->getParameter('offset', 0));
    }

    $q = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, l.id, l.name, a.id, a.name, c.id, c.name')
      ->leftJoin('e.recurringLocation l')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.category c')
      ->where('e.startDate >= ? OR e.endDate >= ?', date('Y-m-d'), date('Y-m-d'))
      ->limit($limit)
      ->offset($offset)
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    $events = $q->execute();

    $this->forward404Unless($events);

    $totalCount = $q->count();
    $count = count($events);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $events,
    );

    return $this->returnJson($data);
  }

  public function executeGetFilteredEvents (sfWebRequest $request) {
    // This method will accept the following parameters:
    // location_id, arranger_id, category_id, startDate, endDate,
    // limit, offset

    $q = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, l.id, l.name, a.id, a.name, c.id, c.name')
      ->leftJoin('e.recurringLocation l')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.category c');

    if ($request->hasParameter('location_id')) {
      $location_id = explode(',', $request->getParameter('location_id'));
      $location_id = array_map(create_function('$value', 'return (int)$value;'), $location_id);
      $q->andWhereIn('e.location_id', $location_id);
    }
    
    if ($request->hasParameter('arranger_id')) {
      $arranger_id = explode(',', $request->getParameter('arranger_id'));
      $arranger_id = array_map(create_function('$value', 'return (int)$value;'), $arranger_id);
      $q->andWhereIn('e.arranger_id', $arranger_id);
    }
    
    if ($request->hasParameter('category_id')) {
      $category_id = explode(',', $request->getParameter('category_id'));
      $category_id = array_map(create_function('$value', 'return (int)$value;'), $category_id);
      $q->andWhereIn('e.category_id', $category_id);
    }

    if ($request->hasParameter('startDate')) {
      $startDate = $request->getParameter('startDate');
      $q->andWhere('e.startDate >= ? OR e.endDate >= ?', array($startDate, $startDate));
    } else {
      $q->andWhere('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')));
    }

    if ($request->hasParameter('endDate')) {
      $endDate = $request->getParameter('endDate');
      $q->andWhere('e.startDate <= ? OR e.endDate <= ?', array($endDate, $endDate));
    }

    $limit = intval($request->getParameter('limit', 20));
    $offset = 0;
    if ($limit > 0) {
      $offset = intval($request->getParameter('offset', 0));
    }

    $q->limit($limit)->offset($offset);
    $q->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    $events = $q->execute();

    $this->forward404Unless($events);
    
    $totalCount = $q->count();
    $count = count($events);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $events,
    );

    return $this->returnJson($data);
  }

  public function returnJson($data){
    $this->data = $data;
    if (sfConfig::get('sf_environment') == 'dev' && !$this->getRequest()->isXmlHttpRequest()) {
      $this->setLayout('json_debug'); 
      $this->setTemplate('json_debug', 'api');
    } else {
      //print_r($data);
      //print_r(json_encode($data));
      //print_r($this->renderText(json_encode($data)));
      //$this->data = $this->renderText(json_encode($data));
      $this->getResponse()->setHttpHeader('Content-type','application/json');
      return $this->renderText(json_encode($data));
      //$this->setLayout('json');
      //$this->setTemplate('json','api');
    }
  }
}
