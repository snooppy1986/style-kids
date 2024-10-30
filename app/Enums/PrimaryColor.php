<?php


namespace App\Enums;

use App\Classes\CustomColors;
use App\Enums\Concerns\Utilities;
use Cassandra\Custom;
use Filament\Support\Colors\Color;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Spatie\Color\Rgb;
use UnexpectedValueException;

enum PrimaryColor: string implements HasColor, HasLabel
{
    use Utilities;

    case Blue = 'Синий';
    case Powder = 'Пудра';
    case Cyan = 'Голубой';
    case Rose = 'Розовый';
    case Beige = 'Бежевый';
    case Peach = 'Персиковый';
    case Gray = 'Серый';
    case Green = 'Зелёный';
    case Black = 'Черный';
    case Gold = 'Золотистый';
    case Yellow = 'Желтый';
    case DarkBlue = 'Темно-синий';
    case White = 'Белый';
    case Red = 'Красный';
    case Bordo = 'Бордовый';
    case LightGrey = 'Светло-серый';
    case Turquoise = 'Бирюзовый';
    case Milk = 'Молочный';
    case Fuchsia = 'Малиновый';
    case Orange = 'Оранжевый';
    case Lilac = 'Сиреневый';

    public function getColor(): string|array|null
    {
        return match($this){
            self::Blue => Color::Blue,
            self::Powder => CustomColors::Powder,
            self::Cyan => Color::Cyan,
            self::Rose => Color::Rose,
            self::Beige => CustomColors::Beige,
            self::Peach => CustomColors::Peach,
            self::Gray => Color::Gray,
            self::Green => Color::Green,
            self::Black => CustomColors::Black,
            self::Gold => CustomColors::Gold,
            self::Yellow => Color::Yellow,
            self::DarkBlue => CustomColors::DarkBlue,
            self::White => CustomColors::White,
            self::Red => Color::Red,
            self::Bordo => CustomColors::Bordo,
            self::LightGrey => CustomColors::LightGrey,
            self::Turquoise => CustomColors::Turquoise,
            self::Milk => CustomColors::Milk,
            self::Fuchsia => Color::Fuchsia,
            self::Orange => Color::Orange,
            self::Lilac => CustomColors::Lilac,
        };
    }

    public function getLabel(): ?string
{
    return ucfirst($this->value);
}

    public function getHexCode(): string
    {
        $colorArray = $this->getColor();

        if($colorArray !== null && isset($colorArray[600])){
            $rgbToString = $colorArray[600];

        return Rgb::fromString("rgb({$rgbToString})")->toHex();
    }

    throw new UnexpectedValueException("The color {$this->value} does not have a hex code.");
}
}
