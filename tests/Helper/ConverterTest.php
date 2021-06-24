<?php declare(strict_types = 1);
  require_once "./autoload.php";

  use PHPUnit\Framework\TestCase;
  use IOTA\Helper\Converter;

  /**
   * Class ConverterTest
   *
   * @author       StefanBraun
   * @copyright    Copyright (c) 2021, StefanBraun
   */
  final class ConverterTest extends TestCase {
    protected string $str = "follow me on Twitter @IOTAphp";
    protected string $hex = "666f6c6c6f77206d65206f6e20547769747465722040494f5441706870";
    protected string $bits = "0110011001101111011011000110110001101111011101110010000001101101011001010010000001101111011011100010000001010100011101110110100101110100011101000110010101110010001000000100000001001001010011110101010001000001011100000110100001110000";
    protected array $byteArray8bits = [
      1  => 102,
      2  => 111,
      3  => 108,
      4  => 108,
      5  => 111,
      6  => 119,
      7  => 32,
      8  => 109,
      9  => 101,
      10 => 32,
      11 => 111,
      12 => 110,
      13 => 32,
      14 => 84,
      15 => 119,
      16 => 105,
      17 => 116,
      18 => 116,
      19 => 101,
      20 => 114,
      21 => 32,
      22 => 64,
      23 => 73,
      24 => 79,
      25 => 84,
      26 => 65,
      27 => 112,
      28 => 104,
      29 => 112,
    ];
    protected array $byteArray5bits = [
      0  => 0,
      1  => 1,
      2  => 19,
      3  => 6,
      4  => 30,
      5  => 27,
      6  => 3,
      7  => 12,
      8  => 13,
      9  => 29,
      10 => 27,
      11 => 18,
      12 => 0,
      13 => 27,
      14 => 11,
      15 => 5,
      16 => 4,
      17 => 1,
      18 => 23,
      19 => 22,
      20 => 28,
      21 => 8,
      22 => 2,
      23 => 20,
      24 => 14,
      25 => 29,
      26 => 20,
      27 => 23,
      28 => 8,
      29 => 29,
      30 => 3,
      31 => 5,
      32 => 14,
      33 => 8,
      34 => 16,
      35 => 4,
      36 => 0,
      37 => 18,
      38 => 10,
      39 => 15,
      40 => 10,
      41 => 17,
      42 => 0,
      43 => 23,
      44 => 0,
      45 => 26,
      46 => 3,
      47 => 16,
    ];
    protected string $base64 = "Zm9sbG93IG1lIG9uIFR3aXR0ZXIgQElPVEFwaHA=";
    protected string $json = '{"data": "follow me on Twitter @IOTAphp"}';
    protected string $binary = b'��$�p��ch�wl�����q){! u��J+ޑ����[BS�0:â���U�����~D�%�������P��0d�F�G�3�n~v��&�櫁D      	 #iota.php1   message test! follow me on Twitter @IOTAphpYM     ';

    public function teststring2Hex(): void {
      $this->assertEquals($this->hex, Converter::string2Hex($this->str));
    }

    public function testhex2String(): void {
      $this->assertEquals($this->str, Converter::hex2String($this->hex));
    }

    public function testbits2Hex(): void {
      $this->assertEquals($this->hex, Converter::bits2Hex($this->bits));
    }

    public function testhex2Bits(): void {
      $this->assertEquals($this->bits, Converter::hex2Bits($this->hex));
    }

    public function testhex2ByteArray(): void {
      $this->assertEquals($this->byteArray8bits, Converter::hex2ByteArray($this->hex));
    }

    public function testbyteArray2Hex(): void {
      $this->assertEquals($this->hex, Converter::byteArray2Hex($this->byteArray8bits));
    }

    public function teststring2ByteArray(): void {
      $this->assertEquals($this->byteArray8bits, Converter::string2ByteArray($this->str));
    }

    public function testbyteArray2String(): void {
      $this->assertEquals($this->str, Converter::byteArray2String($this->byteArray8bits));
    }

    public function testbase64_encode(): void {
      $this->assertEquals($this->base64, Converter::base64_encode($this->str));
    }

    public function testbase64_decode(): void {
      $this->assertEquals($this->str, Converter::base64_decode($this->base64));
    }

    public function testbits(): void {
      $byteArray8bits_copy = $this->byteArray8bits;
      //
      array_unshift($this->byteArray8bits, 0);
      $this->assertEquals($this->byteArray5bits, Converter::bits($this->byteArray8bits, count($this->byteArray8bits), 8, 5, true));
      $this->assertEquals($this->byteArray8bits, Converter::bits($this->byteArray5bits, count($this->byteArray5bits), 5, 8, false));
      unset($this->byteArray8bits[0]);
      $this->assertEquals($this->byteArray8bits, $byteArray8bits_copy);
    }

    public function testisHex(): void {
      $this->assertTrue(Converter::isHex($this->hex));
      $this->assertFalse(Converter::isHex($this->str));
      $this->assertTrue(Converter::isHex($this->bits));
      $this->assertFalse(Converter::isHex($this->byteArray8bits));
    }

    public function testisNumeric(): void {
      $this->assertFalse(Converter::isNumeric($this->hex));
      $this->assertFalse(Converter::isNumeric($this->str));
      $this->assertTrue(Converter::isNumeric($this->bits));
      $this->assertFalse(Converter::isNumeric($this->byteArray8bits));
      $this->assertFalse(Converter::isNumeric($this->base64));
    }

    public function testisUtf8(): void {
      $this->assertFalse(Converter::isUtf8($this->hex));
      $this->assertFalse(Converter::isUtf8($this->str));
      $this->assertFalse(Converter::isUtf8($this->bits));
      $this->assertFalse(Converter::isUtf8($this->byteArray8bits));
      $this->assertFalse(Converter::isUtf8($this->base64));
    }

    public function testisBitwise(): void {
      $this->assertFalse(Converter::isBitwise($this->hex));
      $this->assertFalse(Converter::isBitwise($this->str));
      $this->assertTrue(Converter::isBitwise($this->bits));
      $this->assertFalse(Converter::isBitwise($this->byteArray8bits));
      $this->assertFalse(Converter::isBitwise($this->base64));
    }

    public function testisBase64(): void {
      $this->assertTrue(Converter::isBase64($this->hex));
      $this->assertFalse(Converter::isBase64($this->str));
      $this->assertTrue(Converter::isBase64($this->bits));
      $this->assertFalse(Converter::isBase64($this->byteArray8bits));
      $this->assertTrue(Converter::isBase64($this->base64));
    }

    public function testisBase16(): void {
      $this->assertTrue(Converter::isBase16($this->hex));
      $this->assertFalse(Converter::isBase16($this->str));
      $this->assertTrue(Converter::isBase16($this->bits));
      $this->assertFalse(Converter::isBase16($this->byteArray8bits));
      $this->assertFalse(Converter::isBase16($this->base64));
    }

    public function testisJSON(): void {
      $this->assertTrue(Converter::isJSON($this->json));
    }

    public function testisBinary(): void {
      $this->assertTrue(Converter::isBinary($this->binary));
    }
  }
