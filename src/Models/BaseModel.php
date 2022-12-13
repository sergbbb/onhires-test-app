<?php


namespace Sergbbb\Fin\Models;


use Sergbbb\Fin\Interfaces\ModelInterface;

class BaseModel implements ModelInterface
{

  /**
   * Model identifier
   *
   * @var ?int
   */
  protected ?int $id = null;

  public function setId($value)
  {
    $this->id = $value;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getIdentifierValue()
  {
    return $this->{self::getIdentifierProperty()};
  }

  public function setIdentifierValue($value)
  {
    return $this->{self::getIdentifierProperty()} = $value;
  }

  public static function getIdentifierProperty(): string
  {
    return 'id';
  }

}