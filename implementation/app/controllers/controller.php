<?php

abstract class Controller
{
	protected $arguments;

	protected $model;
    protected $view;
    protected $dataAccessObject;

    protected $authorizer;
    protected $authenticator;

    /*
    abstract protected function get()
    {
    }
    */

    abstract protected function getAll();

    abstract protected function create();

	/*
    abstract protected function delete()
    {
    }
    */

    /*
    abstract protected function update()
    {
    }
    */
}