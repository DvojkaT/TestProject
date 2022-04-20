<?php


namespace App\Domain\Enums;


/**
 * Class EnumBase
 *
 * @package App\Domain\Enums
 */
abstract class EnumBase
{
    /**
     * @var string The value of this enum instance
     */
    private string $value;

    final public function __construct(string $value)
    {
        if (!in_array($value, static::values(), true)) {
            throw new \InvalidArgumentException("The '$value' is not a valid enum value.");
        }

        $this->value = $value;
    }

    /**
     * Хелпер для создания enum'а. Если параметр равен null возвращает null
     *
     * @param string|null $value
     * @return static|null
     */
    public static function createFrom(?string $value)
    {
        if (!$value) {
            return null;
        }

        return new static($value);
    }

    /**
     * Сравнить два объекта этого класса
     *
     * @param self $other Объект для сравнения
     * @return bool
     */
    public function isEqualTo(self $other): bool
    {
        return $this->value === (string)$other;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Получить все возможные значения
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_map(
            fn(\ReflectionClassConstant $constant): string => $constant->getValue(),
            array_filter(
                static::reflection()->getReflectionConstants(),
                fn(\ReflectionClassConstant $constant): bool => $constant->isPublic()
            ));
    }

    protected static function reflection(): \ReflectionClass
    {
        return new \ReflectionClass(static::class);
    }
}
