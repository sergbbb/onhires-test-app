<?php


namespace Sergbbb\Fin\Interfaces;


interface ModelInterface
{
  public function setId($value);
  public function getId();
  public function getIdentifierValue();
  public static function getIdentifierProperty();
}