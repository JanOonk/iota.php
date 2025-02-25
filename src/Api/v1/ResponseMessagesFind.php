<?php namespace IOTA\Api\v1;

use IOTA\Api\ResponseArray;
use IOTA\Models\AbstractApiResponse;

/**
 * Class ResponseMessagesFind
 *
 * @package      IOTA\Api\v1
 * @author       StefanBraun
 * @copyright    Copyright (c) 2021, StefanBraun
 */
class ResponseMessagesFind extends AbstractApiResponse {
  /**
   * @var string
   */
  public string $index;
  /**
   * @var int
   */
  public int $maxResults;
  /**
   * @var int
   */
  public int $count;
  /**
   * @var array
   */
  public ResponseArray $messageIds;

  /**
   *
   */
  protected function parse(): void {
    $this->defaultParse();
  }
}