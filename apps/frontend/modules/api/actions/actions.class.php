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

  public function executeArranger(sfWebRequest $request) {

    $subAction = $request->getParameter('subaction', 'list');

    $q = Doctrine_Core::getTable('arranger')
      ->createQuery('a')
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    if (($subAction == 'get') && ($request->hasParameter('id'))) {
      $limit = 1;
      $offset = 0;

      $q->where('a.id = ?', $request->getParameter('id'));
      $q->limit($limit);
      $dbResponse = $q->execute();

      $totalCount = $q->count();
      $count = count($dbResponse);

    } else if ($subAction == 'list') {
      $limit = intval($request->getParameter('limit', 20));
      $offset = 0;
      if ($limit > 0) {
        $offset = intval($request->getParameter('offset', 0));
      }

      $q->select('a.name, a.id')
      ->limit($limit)
      ->offset($offset);    
    
      $dbResponse = $q->execute();

      $totalCount = $q->count();
      $count = count($dbResponse);
    }

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $dbResponse,
    );

    return $this->returnJson($data);
  }

  public function executeCategory(sfWebRequest $request) {

    $subAction = $request->getParameter('subaction', 'list');

    $q = Doctrine_Core::getTable('category')
      ->createQuery('c')
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    if (($subAction == 'get') && ($request->hasParameter('id'))) {
      $limit = 1;
      $offset = 0;

      $q->where('c.id = ?', $request->getParameter('id'));
      $q->limit($limit);
      $dbResponse = $q->execute();

    } else if ($subAction == 'list') {
      $limit = intval($request->getParameter('limit', 20));
      $offset = 0;
      if ($limit > 0) {
        $offset = intval($request->getParameter('offset', 0));
      }

      $q->select('c.name, c.id')
      ->limit($limit)
      ->offset($offset);    
    
      $dbResponse = $q->execute();
    }

    $totalCount = $q->count();
    $count = count($dbResponse);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $dbResponse,
    );

    return $this->returnJson($data);
  }
  
  public function executeLocation(sfWebRequest $request) {

    $subAction = $request->getParameter('subaction', 'list');

    $q = Doctrine_Core::getTable('location')
      ->createQuery('l')
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    if (($subAction == 'get') && ($request->hasParameter('id'))) {
      $limit = 1;
      $offset = 0;

      $q->where('l.id = ?', $request->getParameter('id'));
      $q->limit($limit);
      $dbResponse = $q->execute();

    } else if ($subAction == 'list') {
      $limit = intval($request->getParameter('limit', 20));
      $offset = 0;
      if ($limit > 0) {
        $offset = intval($request->getParameter('offset', 0));
      }

      $q->select('l.name, l.id')
      ->limit($limit)
      ->offset($offset);
    
      $dbResponse = $q->execute();
    }

    $totalCount = $q->count();
    $count = count($dbResponse);

    $data = array(
      'limit' => $limit,
      'offset' => $offset,
      'count' => $count,
      'totalCount' => $totalCount,
      'data' => $dbResponse,
    );

    return $this->returnJson($data);
  }

  public function executeEvent(sfWebRequest $request) {
    $subAction = $request->getParameter('subaction', 'get');

    if (($subAction == 'get') && ($request->hasParameter('id'))) {
      $limit = 1;
      $offset = 0;

      $q = Doctrine_Core::getTable('event')
        ->createQuery('e')
        ->select('e.*, l.id, l.name, a.id, a.name, c.id, c.name')
        ->leftJoin('e.recurringLocation l')
        ->leftJoin('e.arranger a')
        ->leftJoin('e.category c')
	->where('e.id = ?', $request->getParameter('id'))
        ->limit($limit)
        ->offset($offset)
        ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);
	
      $event = $q->execute();

      $totalCount = $q->count();
      $count = count($event);

      $data = array(
        'limit' => $limit,
        'offset' => $offset,
        'count' => $count,
        'totalCount' => $totalCount,
        'data' => $event,
      );
    }

    return $this->returnJson($data);
  }

  public function executeUpcomingEvents (sfWebRequest $request) {
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
      ->where('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->limit($limit)
      ->offset($offset)
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);

    $events = $q->execute();

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

  public function executeFilteredEvents (sfWebRequest $request) {
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

  public function returnJson($data) {
    $this->data = $data;

    if (sfConfig::get('sf_environment') == 'dev' && !$this->getRequest()->isXmlHttpRequest()) {
      $this->setLayout('json_debug'); 
      $this->setTemplate('json_debug', 'api');
    } else {
      $this->getResponse()->setHttpHeader('Content-type','application/json');

      $string = '';

      if ( isset( $_GET['callback'] ) ) {
        $string = $_GET['callback'] . '(' . json_encode($data) . ')';
      } else {
        $string = json_encode($data);
      }
      return $this->renderText($string);
    }
  }
}
