<?php
namespace DevLucid;

interface MVCInterface
{
    public function findModel(string $name);
    public function loadModel(string $name);
    public function model(string $name, $id=null);

    public function findView(string $name);
    public function loadView(string $name);
    public function view(string $name, $parameters=[]);

    public function findController(string $name);
    public function loadController(string $name);
    public function controller(string $name);

    public function buildParameters($object, string $method, $parameters);
}
