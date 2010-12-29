<?php

/**
 * eventTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class eventTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object eventTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('event');
    }

    public function defaultJoins(Doctrine_Query $q)
    {
        $rootAlias = $q->getRootAlias();

        $q->leftJoin($rootAlias . '.recurringLocation l')
          ->leftJoin($rootAlias . '.arranger a')
          ->leftJoin($rootAlias . '.categories c')
          ->leftJoin($rootAlias . '.festival f');

        return $q;
    }

    public function defaultOrderBy(Doctrine_Query $q)
    {
        $rootAlias = $q->getRootAlias();

        $q->orderBy($rootAlias . '.startDate asc, ' .
                    $rootAlias . '.startTime asc, ' .
                    $rootAlias . '.title asc');
    }
}
