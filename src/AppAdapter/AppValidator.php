<?php

namespace App\AppAdapter;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\ExpressionLanguageSyntax;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Hostname;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\Cidr;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Constraints\Ulid;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\IdenticalTo;
use Symfony\Component\Validator\Constraints\NotIdenticalTo;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Negative;
use Symfony\Component\Validator\Constraints\NegativeOrZero;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Validator\Constraints\Timezone;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Language;
use Symfony\Component\Validator\Constraints\Locale;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Bic;
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Constraints\Luhn;
use Symfony\Component\Validator\Constraints\Iban;
use Symfony\Component\Validator\Constraints\Isbn;
use Symfony\Component\Validator\Constraints\Issn;
use Symfony\Component\Validator\Constraints\Isin;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\Traverse;
use Symfony\Component\Validator\Constraints\Count;

final class AppValidator
{

    public const NOT_BLANK = 'NotBlank';
    public const BLANK = 'Blank';
    public const NOT_NULL = 'NotNull';
    public const IS_NULL = 'IsNull';
    public const IS_TRUE = 'IsTrue';
    public const IS_FALSE = 'IsFalse';
    public const TYPE = 'Type';
    public const EMAIL = 'Email';
    public const EXPRESSION_LANGUAGE_SYNTAX = 'ExpressionLanguageSyntax';
    public const LENGTH = 'Length';
    public const URL = 'Url';
    public const REGEX = 'Regex';
    public const HOSTNAME = 'Hostname';
    public const IP = 'Ip';
    public const CIDR = 'Cidr';
    public const JSON = 'Json';
    public const UUID = 'Uuid';
    public const UL_ID = 'Ulid';
    public const EQUAL_TO = 'EqualTo';
    public const NOT_EQUAL_TO = 'NotEqualTo';
    public const IDENTICAL_TO = 'IdenticalTo';
    public const NOT_IDENTICAL_TO = 'NotIdenticalTo';
    public const LESS_THEN = 'LessThan';
    public const LESS_OR_EQUAL = 'LessThanOrEqual';
    public const GREATER_THAN = 'GreaterThan';
    public const GREAT_THAN_OR_EQUAL = 'GreaterThanOrEqual';
    public const RANGE = 'Range';
    public const DIVISIBLE_BY = 'DivisibleBy';
    public const UNIQUE = 'Unique';
    public const POSITIVE = 'Positive';
    public const POSITIVE_OR_ZERO = 'PositiveOrZero';
    public const NEGATIVE = 'Negative';
    public const NEGATIVE_OR_ZERO = 'NegativeOrZero';
    public const DATE = 'Date';
    public const DATE_TIME = 'DateTime';
    public const TIME = 'Time';
    public const TIMEZONE = 'Timezone';
    public const CHOICE = 'Choice';
    public const LANGUAGE = 'Language';
    public const LOCALE = 'Locale';
    public const COUNTRY = 'Country';
    public const FILE = 'File';
    public const IMAGE = 'Image';
    public const BIC = 'Bic';
    public const CARD_SCHEME = 'CardScheme';
    public const CURRENCY = 'Currency';
    public const LUHN = 'Luhn';
    public const IBAN = 'Iban';
    public const ISBN = 'Isbn';
    public const ISSN = 'Issn';
    public const ISIN = 'Isin';
    public const AT_LEAST_ONE_OF = 'AtLeastOneOf';
    public const SEQUENTIALLY = 'Sequentially';
    public const COMPOUND = 'Compound';
    public const CALLBACK = 'Callback';
    public const EXPRESSION = 'Expression';
    public const ALL = 'All';
    public const VALID = 'Valid';
    public const TRAVERSE = 'Traverse';
    public const COUNT = 'Count';

    private array $arrViolation = [
        self::NOT_BLANK => NotBlank::class,
        self::BLANK => Blank::class,
        self::NOT_NULL => NotNull::class,
        self::IS_NULL => IsNull::class,
        self::IS_TRUE => IsTrue::class,
        self::IS_FALSE => IsFalse::class,
        self::TYPE => Type::class,
        self::EMAIL => Email::class,
        self::EXPRESSION_LANGUAGE_SYNTAX => ExpressionLanguageSyntax::class,
        self::LENGTH => Length::class,
        self::URL => Url::class,
        self::REGEX => Regex::class,
        self::HOSTNAME => Hostname::class,
        self::IP => Ip::class,
        self::CIDR => Cidr::class,
        self::JSON => Json::class,
        self::UUID => Uuid::class,
        self::UL_ID => Ulid::class,
        self::EQUAL_TO => EqualTo::class,
        self::NOT_EQUAL_TO => NotEqualTo::class,
        self::IDENTICAL_TO => IdenticalTo::class,
        self::NOT_IDENTICAL_TO => NotIdenticalTo::class,
        self::LESS_THEN => LessThan::class,
        self::LESS_OR_EQUAL => LessThanOrEqual::class,
        self::GREATER_THAN => GreaterThan::class,
        self::GREAT_THAN_OR_EQUAL => GreaterThanOrEqual::class,
        self::RANGE => Range::class,
        self::DIVISIBLE_BY => DivisibleBy::class,
        self::UNIQUE => Unique::class,
        self::POSITIVE => Positive::class,
        self::POSITIVE_OR_ZERO => PositiveOrZero::class,
        self::NEGATIVE => Negative::class,
        self::NEGATIVE_OR_ZERO => NegativeOrZero::class,
        self::DATE => Date::class,
        self::DATE_TIME => DateTime::class,
        self::TIME => Time::class,
        self::TIMEZONE => Timezone::class,
        self::CHOICE => Choice::class,
        self::LANGUAGE => Language::class,
        self::LOCALE => Locale::class,
        self::COUNTRY => Country::class,
        self::FILE => File::class,
        self::IMAGE => Image::class,
        self::BIC => Bic::class,
        self::CARD_SCHEME => CardScheme::class,
        self::CURRENCY => Currency::class,
        self::LUHN => Luhn::class,
        self::IBAN => Iban::class,
        self::ISBN => Isbn::class,
        self::ISSN => Issn::class,
        self::ISIN => Isin::class,
        self::AT_LEAST_ONE_OF => AtLeastOneOf::class,
        self::SEQUENTIALLY => Sequentially::class,
        self::COMPOUND => Compound::class,
        self::CALLBACK => Callback::class,
        self::EXPRESSION => Expression::class,
        self::ALL => All::class,
        self::VALID => Valid::class,
        self::TRAVERSE => Traverse::class,
        self::COUNT => Count::class,
    ];
    /**
     * @var Validation
     * @implements ValidatorInterface
     */
    private ValidatorInterface $validator;
    private static ?self $instance = null;

    private function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    public static function getAppValidator(): ?AppValidator
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function createCallable($constraintOrValidator = null, Constraint ...$constraints): callable
    {
        return $this->validator::createCallable($constraintOrValidator = null, ...$constraints);
    }

    public function createIsValidCallable($constraintOrValidator = null, Constraint ...$constraints): callable
    {
       return $this->validator::createIsValidCallable($constraintOrValidator = null, ...$constraints);
    }

    public function validate(AppRequest $request, array $constraint) : bool
    {
        switch ($request->getMethod()) {
            case 'POST':
                $dataRequest = $request->getRequestAll();
            break;
            case 'GET':
                $dataRequest = $request->getQueryAll();
            break;
            default:
                return false;
        }

        $constraint = $this->getConstraint($constraint);
        $validation = $this->validator->validate($dataRequest, $constraint);
        if (count($validation) > 0) {
            return false;
        }

        return true;
    }

    private function getConstraint(array $constraint) : Constraint
    {
        $prepareArrayConstraint = [];
        foreach ($constraint as $paramName => $constraints) {
                foreach ($constraints as $nameConstraint => $constraint) {
                    if (is_array($constraint)) {
                        $prepareArrayConstraint[$paramName][] = new $this->arrViolation[$nameConstraint]($constraint);
                        continue;
                    }

                    $prepareArrayConstraint[$paramName][] = new $this->arrViolation[$nameConstraint]();
                }
        }

        return new Collection($prepareArrayConstraint);
    }
}
