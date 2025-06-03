<?php

interface Toy {
    public function play(): string;
}

abstract class Car implements Toy {
    public function play() : string {
        return "Play Car";
    }
}

class LittleCarToy extends Car {
}

class MiddleCarToy extends Car {
}

abstract class Doll implements Toy {
    public function play(): string {
        return "Play Doll";
    }
}

class LittleDollToy extends Doll {
}

class MiddleDollToy extends Doll {
}

interface ToyFactory {
    public function makeForKids(): Toy;
    public function makeForChild(): Toy;
}

 class CarFactory implements ToyFactory {
    public function makeForChild(): Toy
    {
        return new LittleCarToy();
    }

    public function makeForKids(): Toy
    {
        return new MiddleCarToy();
    }
 }

 class DollFactory implements ToyFactory {
    public function makeForChild(): Toy
    {
        return new LittleDollToy();
    }

    public function makeForKids(): Toy
    {
        return new MiddleDollToy();
    }
 }

 abstract class AbstractToyFactory {
    public static function makeToy(ToyFactory $factory, string $ageGroup): Toy {
        return match ($ageGroup) {
            'child' => $factory->makeForChild(),
            'kid' => $factory->makeForKids(),
            default => throw new InvalidArgumentException("Invalid age group: $ageGroup"),
        };
    }
}

$toy1 = AbstractToyFactory::makeToy(new CarFactory(), 'child');
echo $toy1->play(); // Output: Playing with a little car!

echo "\n";

$toy2 = AbstractToyFactory::makeToy(new DollFactory(), 'kid');
echo $toy2->play();