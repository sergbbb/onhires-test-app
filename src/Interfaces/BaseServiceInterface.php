<?php


namespace Sergbbb\Fin\Interfaces;


interface BaseServiceInterface
{
  public function getByIdentifier($identifier);
  public function getAll();
}