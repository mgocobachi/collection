<?php
use PHPUnit\Framework\TestCase;
use Gocobachi\Collection;

/**
 * @covers \Gocobachi\Collection
 */
 final class CollectionTest extends TestCase
 {
     public function testInstance(): void
     {
         $this->assertInstanceOf(
             Collection::class,
             collection([])
         );
     }

     public function testParamMustBeArray(): void
     {
         $this->expectException(TypeError::class);

         $this->assertInstanceOf(
             Collection::class,
             collection('test')
         );
     }

     public function testAllMethodIsArray(): void
     {
         $this->assertTrue(is_array(collection([])->all()));
     }

     public function testFirst(): void
     {
         $items = [1, 2, 3];

         $this->assertEquals(current($items), collection($items)->first());
     }

     public function testEachCallException(): void
     {
         $this->expectException(Exception::class);

         $users = $this->getMockData();

         collection($users)->each(function ($user) {
             throw new Exception($user['name']);
         });
     }

     public function testEach(): void
     {
         $users  = $expected = $this->getMockData();
         $actual = collection($users)->each(function () {
         });

         $this->assertEquals($expected, $actual->all());
     }

     public function testMap(): void
     {
         $users    = $this->getMockData();
         $expected = [
             $users[0]['email'],
             $users[1]['email'],
             $users[2]['email'],
             $users[3]['email'],
         ];

         $actual = collection($users)->map(function ($user) {
             return $user['email'];
         })->all();

         $this->assertEquals($expected, $actual);
     }

     public function testFilter(): void
     {
         $users  = $this->getMockData();
         $actual = collection($users)->filter(function ($user) {
             return !empty($user['email']);
         })->all();

         $this->assertArraySubset($users[0], $actual[0]);
         $this->assertArraySubset($users[2], $actual[2]);
     }

     public function testReduce(): void
     {
         $expected = 10;
         $actual   = collection([2, 2, 4, 1, 1])->reduce(function ($sum, $n) {
             return $sum + $n;
         })->first();

         $this->assertEquals($expected, $actual);
     }

     public function testReverse(): void
     {
         $expected = [8, 4, 10, 2];
         $actual   = collection([2, 10, 4, 8])->reverse(function ($n) {
             return $n;
         })->all();

         $this->assertEquals($expected, $actual);
     }

     public function getMockData(): array
     {
         return [
             [
                 'name'  => 'Jhon',
                 'email' => 'john@doe.com'
             ],
             [
                 'name'  => 'Clark',
                 'email' => null,
             ],
             [
                 'name'  => 'Jennifer',
                 'email' => 'jennifer@email.com'
             ],
             [
                 'name'  => 'Jimmy',
                 'email' => null,
             ],
         ];
     }
 }
