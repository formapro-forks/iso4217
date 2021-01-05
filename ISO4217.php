<?php

/**
 * (c) Rob Bast <rob.bast@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Payum\ISO4217;

/**
 * A library providing ISO 4217 data.
 * @deprecated This class is deprecated. Use Alcohol\ISO4217 instead
 */
class ISO4217
{
    /**
     * @param string $code
     * @return Currency
     * @throws \RuntimeException
     */
    public function findByCode($code)
    {
        foreach (static::$rawCurrencies as $currency) {
            if (0 === strcasecmp($code, $currency['alpha3'])) {
                return $this->create($currency);
            }
        }

        throw new \RuntimeException('ISO 4217 does not contain: ' . $code);
    }

    /**
     * @param string $alpha3
     * @return Currency
     * @throws \InvalidArgumentException
     */
    public function findByAlpha3($alpha3)
    {
        if (!preg_match('/^[a-zA-Z]{3}$/', $alpha3)) {
            throw new \InvalidArgumentException('Not a valid alpha3: ' . $alpha3);
        }

        return $this->findByCode($alpha3);
    }

    /**
     * @param string $numeric
     * @return Currency
     * @throws \RuntimeException
     */
    public function findByNumeric($numeric)
    {
        if (!preg_match('/^[0-9]{3}$/', $numeric)) {
            throw new \InvalidArgumentException('Not a valid numeric: ' . $numeric);
        }

        foreach (static::$rawCurrencies as $currency) {
            if (0 === strcasecmp($numeric, $currency['numeric'])) {
                return $this->create($currency);
            }
        }

        throw new \RuntimeException('ISO 4217 does not contain: ' . $numeric);
    }

    /**
     * @return Currency[]
     */
    public function findAll()
    {
        $currencies = array();

        foreach (static::$rawCurrencies as $currency) {
            $currencies[] = $this->create($currency);
        }

        return $currencies;
    }

    /**
     * @param string[] $currency
     *
     * @return Currency
     */
    protected function create(array $currency)
    {
        if (false == isset($this->currencies[$currency['alpha3']])) {
            $this->currencies[$currency['alpha3']] = new Currency(
                $currency['name'],
                $currency['alpha3'],
                $currency['numeric'],
                $currency['exp'],
                $currency['country']
            );
        }

        return $this->currencies[$currency['alpha3']];
    }

    /**
     * @var Currency[]
     */
    protected $currencies = array();

    /**
     * @var array
     */
    protected static $rawCurrencies = array(
        array(
            'name' => 'UAE Dirham',
            'alpha3' => 'AED',
            'numeric' => '784',
            'exp' => 2,
            'country' => 'AE',
        ),
        array(
            'name' => 'Afghan Afghani',
            'alpha3' => 'AFN',
            'numeric' => '971',
            'exp' => 2,
            'country' => 'AF',
        ),
        array(
            'name' => 'Albanian Lek',
            'alpha3' => 'ALL',
            'numeric' => '008',
            'exp' => 2,
            'country' => 'AL',
        ),
        array(
            'name' => 'Armenian Dram',
            'alpha3' => 'AMD',
            'numeric' => '051',
            'exp' => 2,
            'country' => 'AM',
        ),
        array(
            'name' => 'Netherlands Antillean Guilder',
            'alpha3' => 'ANG',
            'numeric' => '532',
            'exp' => 2,
            'country' => array('CW', 'SX'),
        ),
        array(
            'name' => 'Angolan Kwanza',
            'alpha3' => 'AOA',
            'numeric' => '973',
            'exp' => 2,
            'country' => 'AO',
        ),
        array(
            'name' => 'Argentine Peso',
            'alpha3' => 'ARS',
            'numeric' => '032',
            'exp' => 2,
            'country' => 'AR',
        ),
        array(
            'name' => 'Australian Dollar',
            'alpha3' => 'AUD',
            'numeric' => '036',
            'exp' => 2,
            'country' =>
                array('AU', 'CC', 'CX', 'HM', 'KI', 'NF', 'NR', 'TV'),
        ),
        array(
            'name' => 'Aruban Florin',
            'alpha3' => 'AWG',
            'numeric' => '533',
            'exp' => 2,
            'country' => 'AW',
        ),
        array(
            'name' => 'Azerbaijani Manat',
            'alpha3' => 'AZN',
            'numeric' => '944',
            'exp' => 2,
            'country' => 'AZ',
        ),
        array(
            'name' => 'Bosnia and Herzegovina Convertible Mark',
            'alpha3' => 'BAM',
            'numeric' => '977',
            'exp' => 2,
            'country' => 'BA',
        ),
        array(
            'name' => 'Barbados Dollar',
            'alpha3' => 'BBD',
            'numeric' => '052',
            'exp' => 2,
            'country' => 'BB',
        ),
        array(
            'name' => 'Bangladeshi Taka',
            'alpha3' => 'BDT',
            'numeric' => '050',
            'exp' => 2,
            'country' => 'BD',
        ),
        array(
            'name' => 'Bulgarian Lev',
            'alpha3' => 'BGN',
            'numeric' => '975',
            'exp' => 2,
            'country' => 'BG',
        ),
        array(
            'name' => 'Bahraini Dinar',
            'alpha3' => 'BHD',
            'numeric' => '048',
            'exp' => 3,
            'country' => 'BH',
        ),
        array(
            'name' => 'Burundian Franc',
            'alpha3' => 'BIF',
            'numeric' => '108',
            'exp' => 0,
            'country' => 'BI',
        ),
        array(
            'name' => 'Bermudian Dollar',
            'alpha3' => 'BMD',
            'numeric' => '060',
            'exp' => 2,
            'country' => 'BM',
        ),
        array(
            'name' => 'Brunei Dollar',
            'alpha3' => 'BND',
            'numeric' => '096',
            'exp' => 2,
            'country' => 'BN',
        ),
        array(
            'name' => 'Boliviano',
            'alpha3' => 'BOB',
            'numeric' => '068',
            'exp' => 2,
            'country' => 'BO',
        ),
        array(
            'name' => 'Brazilian Real',
            'alpha3' => 'BRL',
            'numeric' => '986',
            'exp' => 2,
            'country' => 'BR',
        ),
        array(
            'name' => 'Bahamian Dollar',
            'alpha3' => 'BSD',
            'numeric' => '044',
            'exp' => 2,
            'country' => 'BS',
        ),
        array(
            'name' => 'Bhutanese Ngultrum',
            'alpha3' => 'BTN',
            'numeric' => '064',
            'exp' => 2,
            'country' => 'BT',
        ),
        array(
            'name' => 'Botswana Pula',
            'alpha3' => 'BWP',
            'numeric' => '072',
            'exp' => 2,
            'country' => array('BW', 'ZW'),
        ),
        array(
            'name' => 'Belarussian Ruble',
            'alpha3' => 'BYR',
            'numeric' => '974',
            'exp' => 0,
            'country' => 'BY',
        ),
        array(
            'name' => 'Belize Dollar',
            'alpha3' => 'BZD',
            'numeric' => '084',
            'exp' => 2,
            'country' => 'BZ',
        ),
        array(
            'name' => 'Canadian Dollar',
            'alpha3' => 'CAD',
            'numeric' => '124',
            'exp' => 2,
            'country' => 'CA',
        ),
        array(
            'name' => 'Congolese Franc',
            'alpha3' => 'CDF',
            'numeric' => '976',
            'exp' => 2,
            'country' => 'CD',
        ),
        array(
            'name' => 'Swiss Franc',
            'alpha3' => 'CHF',
            'numeric' => '756',
            'exp' => 2,
            'country' => array('CH', 'LI'),
        ),
        array(
            'name' => 'Chilean Peso',
            'alpha3' => 'CLP',
            'numeric' => '152',
            'exp' => 0,
            'country' => 'CL',
        ),
        array(
            'name' => 'Chinese Yuan',
            'alpha3' => 'CNY',
            'numeric' => '156',
            'exp' => 2,
            'country' => 'CN',
        ),
        array(
            'name' => 'Colombian Peso',
            'alpha3' => 'COP',
            'numeric' => '170',
            'exp' => 2,
            'country' => 'CO',
        ),
        array(
            'name' => 'Costa Rican Colon',
            'alpha3' => 'CRC',
            'numeric' => '188',
            'exp' => 2,
            'country' => 'CR',
        ),
        array(
            'name' => 'Cuban Convertible Peso',
            'alpha3' => 'CUC',
            'numeric' => '931',
            'exp' => 2,
            'country' => 'CU',
        ),
        array(
            'name' => 'Cuban Peso',
            'alpha3' => 'CUP',
            'numeric' => '192',
            'exp' => 2,
            'country' => 'CU',
        ),
        array(
            'name' => 'Cape Verde Escudo',
            'alpha3' => 'CVE',
            'numeric' => '132',
            'exp' => 2,
            'country' => 'CV',
        ),
        array(
            'name' => 'Czech Koruna',
            'alpha3' => 'CZK',
            'numeric' => '203',
            'exp' => 2,
            'country' => 'CZ',
        ),
        array(
            'name' => 'Djiboutian Franc',
            'alpha3' => 'DJF',
            'numeric' => '262',
            'exp' => 0,
            'country' => 'DJ',
        ),
        array(
            'name' => 'Danish Krone',
            'alpha3' => 'DKK',
            'numeric' => '208',
            'exp' => 2,
            'country' => array('DK', 'FO', 'GL'),
        ),
        array(
            'name' => 'Dominican Peso',
            'alpha3' => 'DOP',
            'numeric' => '214',
            'exp' => 2,
            'country' => 'DO',
        ),
        array(
            'name' => 'Algerian Dinar',
            'alpha3' => 'DZD',
            'numeric' => '012',
            'exp' => 2,
            'country' => 'DZ',
        ),
        array(
            'name' => 'Egyptian Pound',
            'alpha3' => 'EGP',
            'numeric' => '818',
            'exp' => 2,
            'country' => 'EG',
        ),
        array(
            'name' => 'Eritrean Nakfa',
            'alpha3' => 'ERN',
            'numeric' => '232',
            'exp' => 2,
            'country' => 'ER',
        ),
        array(
            'name' => 'Ethiopian Birr',
            'alpha3' => 'ETB',
            'numeric' => '230',
            'exp' => 2,
            'country' => 'ET',
        ),
        array(
            'name' => 'Euro',
            'alpha3' => 'EUR',
            'numeric' => '978',
            'exp' => 2,
            'country' => array('AD', 'AT', 'AX', 'BE', 'BL', 'CY', 'DE', 'EE', 'ES', 'FI', 'FR', 'GF', 'GP', 'GR', 'IE', 'IT', 'LT',
                'LU', 'LV', 'MC', 'ME', 'MF', 'MQ', 'MT', 'NL', 'PM', 'PT', 'RE', 'SI', 'SK', 'SM', 'TF', 'VA', 'YT', 'ZW'),
        ),
        array(
            'name' => 'Fiji Dollar',
            'alpha3' => 'FJD',
            'numeric' => '242',
            'exp' => 2,
            'country' => 'FJ',
        ),
        array(
            'name' => 'Falkland Islands Pound',
            'alpha3' => 'FKP',
            'numeric' => '238',
            'exp' => 2,
            'country' => 'FK',
        ),
        array(
            'name' => 'Pound Sterling',
            'alpha3' => 'GBP',
            'numeric' => '826',
            'exp' => 2,
            'country' => array('GB', 'GG', 'GS', 'IM', 'IO', 'JE', 'ZW'),
        ),
        array(
            'name' => 'Georgian Lari',
            'alpha3' => 'GEL',
            'numeric' => '981',
            'exp' => 2,
            'country' => 'GE',
        ),
        array(
            'name' => 'Ghanaian Cedi',
            'alpha3' => 'GHS',
            'numeric' => '936',
            'exp' => 2,
            'country' => 'GH',
        ),
        array(
            'name' => 'Gibraltar Pound',
            'alpha3' => 'GIP',
            'numeric' => '292',
            'exp' => 2,
            'country' => 'GI',
        ),
        array(
            'name' => 'Gambian Dalasi',
            'alpha3' => 'GMD',
            'numeric' => '270',
            'exp' => 2,
            'country' => 'GM',
        ),
        array(
            'name' => 'Guinean Franc',
            'alpha3' => 'GNF',
            'numeric' => '324',
            'exp' => 0,
            'country' => 'GN',
        ),
        array(
            'name' => 'Guatemalan Quetzal',
            'alpha3' => 'GTQ',
            'numeric' => '320',
            'exp' => 2,
            'country' => 'GT',
        ),
        array(
            'name' => 'Guyanese Dollar',
            'alpha3' => 'GYD',
            'numeric' => '328',
            'exp' => 2,
            'country' => 'GY',
        ),
        array(
            'name' => 'Hong Kong Dollar',
            'alpha3' => 'HKD',
            'numeric' => '344',
            'exp' => 2,
            'country' => 'HK',
        ),
        array(
            'name' => 'Honduran Lempira',
            'alpha3' => 'HNL',
            'numeric' => '340',
            'exp' => 2,
            'country' => 'HN',
        ),
        array(
            'name' => 'Croatian Kuna',
            'alpha3' => 'HRK',
            'numeric' => '191',
            'exp' => 2,
            'country' => 'HR',
        ),
        array(
            'name' => 'Haitian Gourde',
            'alpha3' => 'HTG',
            'numeric' => '332',
            'exp' => 2,
            'country' => 'HT',
        ),
        array(
            'name' => 'Hungarian Forint',
            'alpha3' => 'HUF',
            'numeric' => '348',
            'exp' => 2,
            'country' => 'HU',
        ),
        array(
            'name' => 'Indonesian Rupiah',
            'alpha3' => 'IDR',
            'numeric' => '360',
            'exp' => 2,
            'country' => 'ID',
        ),
        array(
            'name' => 'Israeli New Sheqel',
            'alpha3' => 'ILS',
            'numeric' => '376',
            'exp' => 2,
            'country' =>
                array('IL', 'PS'),
        ),
        array(
            'name' => 'Indian Rupee',
            'alpha3' => 'INR',
            'numeric' => '356',
            'exp' => 2,
            'country' => 'IN',
        ),
        array(
            'name' => 'Iraqi Dinar',
            'alpha3' => 'IQD',
            'numeric' => '368',
            'exp' => 3,
            'country' => 'IQ',
        ),
        array(
            'name' => 'Iranian Rial',
            'alpha3' => 'IRR',
            'numeric' => '364',
            'exp' => 2,
            'country' => 'IR',
        ),
        array(
            'name' => 'Icelandic Króna',
            'alpha3' => 'ISK',
            'numeric' => '352',
            'exp' => 0,
            'country' => 'IS',
        ),
        array(
            'name' => 'Jamaican Dollar',
            'alpha3' => 'JMD',
            'numeric' => '388',
            'exp' => 2,
            'country' => 'JM',
        ),
        array(
            'name' => 'Jordanian Dinar',
            'alpha3' => 'JOD',
            'numeric' => '400',
            'exp' => 3,
            'country' => 'JO',
        ),
        array(
            'name' => 'Japanese Yen',
            'alpha3' => 'JPY',
            'numeric' => '392',
            'exp' => 0,
            'country' => 'JP',
        ),
        array(
            'name' => 'Kenyan Shilling',
            'alpha3' => 'KES',
            'numeric' => '404',
            'exp' => 2,
            'country' => 'KE',
        ),
        array(
            'name' => 'Kyrgyzstani Som',
            'alpha3' => 'KGS',
            'numeric' => '417',
            'exp' => 2,
            'country' => 'KG',
        ),
        array(
            'name' => 'Cambodian Riel',
            'alpha3' => 'KHR',
            'numeric' => '116',
            'exp' => 2,
            'country' => 'KH',
        ),
        array(
            'name' => 'Comoro Franc',
            'alpha3' => 'KMF',
            'numeric' => '174',
            'exp' => 0,
            'country' => 'KM',
        ),
        array(
            'name' => 'North Korean Won',
            'alpha3' => 'KPW',
            'numeric' => '408',
            'exp' => 2,
            'country' => 'KP',
        ),
        array(
            'name' => 'South Korean Won',
            'alpha3' => 'KRW',
            'numeric' => '410',
            'exp' => 0,
            'country' => 'KR',
        ),
        array(
            'name' => 'Kuwaiti Dinar',
            'alpha3' => 'KWD',
            'numeric' => '414',
            'exp' => 3,
            'country' => 'KW',
        ),
        array(
            'name' => 'Cayman Islands Dollar',
            'alpha3' => 'KYD',
            'numeric' => '136',
            'exp' => 2,
            'country' => 'KY',
        ),
        array(
            'name' => 'Kazakhstani Tenge',
            'alpha3' => 'KZT',
            'numeric' => '398',
            'exp' => 2,
            'country' => 'KZ',
        ),
        array(
            'name' => 'Lao Kip',
            'alpha3' => 'LAK',
            'numeric' => '418',
            'exp' => 2,
            'country' => 'LA',
        ),
        array(
            'name' => 'Lebanese Pound',
            'alpha3' => 'LBP',
            'numeric' => '422',
            'exp' => 2,
            'country' => 'LB',
        ),
        array(
            'name' => 'Sri Lankan Rupee',
            'alpha3' => 'LKR',
            'numeric' => '144',
            'exp' => 2,
            'country' => 'LK',
        ),
        array(
            'name' => 'Liberian Dollar',
            'alpha3' => 'LRD',
            'numeric' => '430',
            'exp' => 2,
            'country' => 'LR',
        ),
        array(
            'name' => 'Lesotho Loti',
            'alpha3' => 'LSL',
            'numeric' => '426',
            'exp' => 2,
            'country' => 'LS',
        ),
        array(
            'name' => 'Libyan Dinar',
            'alpha3' => 'LYD',
            'numeric' => '434',
            'exp' => 3,
            'country' => 'LY',
        ),
        array(
            'name' => 'Moroccan Dirham',
            'alpha3' => 'MAD',
            'numeric' => '504',
            'exp' => 2,
            'country' => array('EH', 'MA'),
        ),
        array(
            'name' => 'Moldovan Leu',
            'alpha3' => 'MDL',
            'numeric' => '498',
            'exp' => 2,
            'country' => 'MD',
        ),
        array(
            'name' => 'Malagasy Ariary',
            'alpha3' => 'MGA',
            'numeric' => '969',
            'exp' => 0,
            'country' => 'MG',
        ),
        array(
            'name' => 'Macedonian Denar',
            'alpha3' => 'MKD',
            'numeric' => '807',
            'exp' => 2,
            'country' => 'MK',
        ),
        array(
            'name' => 'Myanmar Kyat',
            'alpha3' => 'MMK',
            'numeric' => '104',
            'exp' => 2,
            'country' => 'MM',
        ),
        array(
            'name' => 'Mongolian Tugrik',
            'alpha3' => 'MNT',
            'numeric' => '496',
            'exp' => 2,
            'country' => 'MN',
        ),
        array(
            'name' => 'Macanese Pataca',
            'alpha3' => 'MOP',
            'numeric' => '446',
            'exp' => 2,
            'country' => 'MO',
        ),
        array(
            'name' => 'Mauritanian Ouguiya',
            'alpha3' => 'MRO',
            'numeric' => '478',
            'exp' => 0,
            'country' => 'MR',
        ),
        array(
            'name' => 'Mauritian Rupee',
            'alpha3' => 'MUR',
            'numeric' => '480',
            'exp' => 2,
            'country' => 'MU',
        ),
        array(
            'name' => 'Maldivian Rufiyaa',
            'alpha3' => 'MVR',
            'numeric' => '462',
            'exp' => 2,
            'country' => 'MV',
        ),
        array(
            'name' => 'Malawian Kwacha',
            'alpha3' => 'MWK',
            'numeric' => '454',
            'exp' => 2,
            'country' => 'MW',
        ),
        array(
            'name' => 'Mexican Peso',
            'alpha3' => 'MXN',
            'numeric' => '484',
            'exp' => 2,
            'country' => 'MX',
        ),
        array(
            'name' => 'Malaysian Ringgit',
            'alpha3' => 'MYR',
            'numeric' => '458',
            'exp' => 2,
            'country' => 'MY',
        ),
        array(
            'name' => 'Mozambican Metical',
            'alpha3' => 'MZN',
            'numeric' => '943',
            'exp' => 2,
            'country' => 'MZ',
        ),
        array(
            'name' => 'Namibian Dollar',
            'alpha3' => 'NAD',
            'numeric' => '516',
            'exp' => 2,
            'country' => 'NA',
        ),
        array(
            'name' => 'Nigerian Naira',
            'alpha3' => 'NGN',
            'numeric' => '566',
            'exp' => 2,
            'country' => 'NG',
        ),
        array(
            'name' => 'Nicaraguan Córdoba',
            'alpha3' => 'NIO',
            'numeric' => '558',
            'exp' => 2,
            'country' => 'NI',
        ),
        array(
            'name' => 'Norwegian Krone',
            'alpha3' => 'NOK',
            'numeric' => '578',
            'exp' => 2,
            'country' =>
                array('AQ', 'BV', 'NO', 'SJ'),
        ),
        array(
            'name' => 'Nepalese Rupee',
            'alpha3' => 'NPR',
            'numeric' => '524',
            'exp' => 2,
            'country' => 'NP',
        ),
        array(
            'name' => 'New Zealand Dollar',
            'alpha3' => 'NZD',
            'numeric' => '554',
            'exp' => 2,
            'country' => array('CK', 'NU', 'NZ', 'PN', 'TK'),
        ),
        array(
            'name' => 'Omani Rial',
            'alpha3' => 'OMR',
            'numeric' => '512',
            'exp' => 3,
            'country' => 'OM',
        ),
        array(
            'name' => 'Panamanian Balboa',
            'alpha3' => 'PAB',
            'numeric' => '590',
            'exp' => 2,
            'country' => 'PA',
        ),
        array(
            'name' => 'Peruvian Nuevo Sol',
            'alpha3' => 'PEN',
            'numeric' => '604',
            'exp' => 2,
            'country' => 'PE',
        ),
        array(
            'name' => 'Papua New Guinean Kina',
            'alpha3' => 'PGK',
            'numeric' => '598',
            'exp' => 2,
            'country' => 'PG',
        ),
        array(
            'name' => 'Philippine Peso',
            'alpha3' => 'PHP',
            'numeric' => '608',
            'exp' => 2,
            'country' => 'PH',
        ),
        array(
            'name' => 'Pakistani Rupee',
            'alpha3' => 'PKR',
            'numeric' => '586',
            'exp' => 2,
            'country' => 'PK',
        ),
        array(
            'name' => 'Polish Zloty',
            'alpha3' => 'PLN',
            'numeric' => '985',
            'exp' => 2,
            'country' => 'PL',
        ),
        array(
            'name' => 'Paraguayan Guarani',
            'alpha3' => 'PYG',
            'numeric' => '600',
            'exp' => 0,
            'country' => 'PY',
        ),
        array(
            'name' => 'Qatari Rial',
            'alpha3' => 'QAR',
            'numeric' => '634',
            'exp' => 2,
            'country' => 'QA',
        ),
        array(
            'name' => 'Romanian New Leu',
            'alpha3' => 'RON',
            'numeric' => '946',
            'exp' => 2,
            'country' => 'RO',
        ),
        array(
            'name' => 'Serbian Dinar',
            'alpha3' => 'RSD',
            'numeric' => '941',
            'exp' => 0,
            'country' => 'RS',
        ),
        array(
            'name' => 'Russian Ruble',
            'alpha3' => 'RUB',
            'numeric' => '643',
            'exp' => 2,
            'country' => 'RU',
        ),
        array(
            'name' => 'Rwandan Franc',
            'alpha3' => 'RWF',
            'numeric' => '646',
            'exp' => 0,
            'country' => 'RW',
        ),
        array(
            'name' => 'Saudi Riyal',
            'alpha3' => 'SAR',
            'numeric' => '682',
            'exp' => 2,
            'country' => 'SA',
        ),
        array(
            'name' => 'Solomon Islands Dollar',
            'alpha3' => 'SBD',
            'numeric' => '090',
            'exp' => 2,
            'country' => 'SB',
        ),
        array(
            'name' => 'Seychelles Rupee',
            'alpha3' => 'SCR',
            'numeric' => '690',
            'exp' => 2,
            'country' => 'SC',
        ),
        array(
            'name' => 'Sudanese Pound',
            'alpha3' => 'SDG',
            'numeric' => '938',
            'exp' => 2,
            'country' => 'SD',
        ),
        array(
            'name' => 'Swedish Krona',
            'alpha3' => 'SEK',
            'numeric' => '752',
            'exp' => 2,
            'country' => 'SE',
        ),
        array(
            'name' => 'Singapore Dollar',
            'alpha3' => 'SGD',
            'numeric' => '702',
            'exp' => 2,
            'country' => array('BN', 'SG'),
        ),
        array(
            'name' => 'Saint Helena Pound',
            'alpha3' => 'SHP',
            'numeric' => '654',
            'exp' => 2,
            'country' => 'SH',
        ),
        array(
            'name' => 'Sierra Leonean Leone',
            'alpha3' => 'SLL',
            'numeric' => '694',
            'exp' => 2,
            'country' => 'SL',
        ),
        array(
            'name' => 'Somali Shilling',
            'alpha3' => 'SOS',
            'numeric' => '706',
            'exp' => 2,
            'country' => 'SO',
        ),
        array(
            'name' => 'Surinamese Dollar',
            'alpha3' => 'SRD',
            'numeric' => '968',
            'exp' => 2,
            'country' => 'SR',
        ),
        array(
            'name' => 'South Sudanese Pound',
            'alpha3' => 'SSP',
            'numeric' => '728',
            'exp' => 2,
            'country' => 'SS',
        ),
        array(
            'name' => 'São Tomé and Principe Dobra',
            'alpha3' => 'STD',
            'numeric' => '678',
            'exp' => 2,
            'country' => 'ST',
        ),
        array(
            'name' => 'Syrian Pound',
            'alpha3' => 'SYP',
            'numeric' => '760',
            'exp' => 2,
            'country' => 'SY',
        ),
        array(
            'name' => 'Swazi Lilangeni',
            'alpha3' => 'SZL',
            'numeric' => '748',
            'exp' => 2,
            'country' => 'SZ',
        ),
        array(
            'name' => 'Thai Baht',
            'alpha3' => 'THB',
            'numeric' => '764',
            'exp' => 2,
            'country' => 'TH',
        ),
        array(
            'name' => 'Tajikistani Somoni',
            'alpha3' => 'TJS',
            'numeric' => '972',
            'exp' => 2,
            'country' => 'TJ',
        ),
        array(
            'name' => 'Turkmenistani Manat',
            'alpha3' => 'TMT',
            'numeric' => '934',
            'exp' => 2,
            'country' => 'TM',
        ),
        array(
            'name' => 'Tunisian Dinar',
            'alpha3' => 'TND',
            'numeric' => '788',
            'exp' => 3,
            'country' => 'TN',
        ),
        array(
            'name' => 'Tongan Paʻanga',
            'alpha3' => 'TOP',
            'numeric' => '776',
            'exp' => 2,
            'country' => 'TO',
        ),
        array(
            'name' => 'Turkish Lira',
            'alpha3' => 'TRY',
            'numeric' => '949',
            'exp' => 2,
            'country' => 'TR',
        ),
        array(
            'name' => 'Trinidad and Tobago Dollar',
            'alpha3' => 'TTD',
            'numeric' => '780',
            'exp' => 2,
            'country' => 'TT',
        ),
        array(
            'name' => 'New Taiwan Dollar',
            'alpha3' => 'TWD',
            'numeric' => '901',
            'exp' => 2,
            'country' => 'TW',
        ),
        array(
            'name' => 'Tanzanian Shilling',
            'alpha3' => 'TZS',
            'numeric' => '834',
            'exp' => 2,
            'country' => 'TZ',
        ),
        array(
            'name' => 'Ukrainian Hryvnia',
            'alpha3' => 'UAH',
            'numeric' => '980',
            'exp' => 2,
            'country' => 'UA',
        ),
        array(
            'name' => 'Ugandan Shilling',
            'alpha3' => 'UGX',
            'numeric' => '800',
            'exp' => 0,
            'country' => 'UG',
        ),
        array(
            'name' => 'US Dollar',
            'alpha3' => 'USD',
            'numeric' => '840',
            'exp' => 2,
            'country' => array('AS', 'BQ', 'EC', 'FM', 'GU', 'MF', 'MH', 'MP', 'PR', 'PW', 'SV', 'TC', 'TL', 'UM', 'US', 'VG', 'VI', 'ZW'),
        ),
        array(
            'name' => 'Uruguayan Peso',
            'alpha3' => 'UYU',
            'numeric' => '858',
            'exp' => 2,
            'country' => 'UY',
        ),
        array(
            'name' => 'Uzbekistan Som',
            'alpha3' => 'UZS',
            'numeric' => '860',
            'exp' => 2,
            'country' => 'UZ',
        ),
        array(
            'name' => 'Venezuelan Bolivar',
            'alpha3' => 'VEF',
            'numeric' => '937',
            'exp' => 2,
            'country' => 'VE',
        ),
        array(
            'name' => 'Vietnamese Dong',
            'alpha3' => 'VND',
            'numeric' => '704',
            'exp' => 0,
            'country' => 'VN',
        ),
        array(
            'name' => 'Vanuatu Vatu',
            'alpha3' => 'VUV',
            'numeric' => '548',
            'exp' => 0,
            'country' => 'VU',
        ),
        array(
            'name' => 'Samoan Tala',
            'alpha3' => 'WST',
            'numeric' => '882',
            'exp' => 2,
            'country' => 'WS',
        ),
        array(
            'name' => 'CFA Franc BEAC',
            'alpha3' => 'XAF',
            'numeric' => '950',
            'exp' => 0,
            'country' => array('CF', 'CG', 'CM', 'GA', 'GQ', 'TD'),
        ),
        array(
            'name' => 'East Caribbean Dollar',
            'alpha3' => 'XCD',
            'numeric' => '951',
            'exp' => 2,
            'country' =>
                array('AG', 'AI', 'DM', 'GD', 'KN', 'LC', 'MS', 'VC'),
        ),
        array(
            'name' => 'CFA Franc BCEAO',
            'alpha3' => 'XOF',
            'numeric' => '952',
            'exp' => 0,
            'country' => array('BJ', 'BF', 'CI', 'GW', 'ML', 'NE', 'SN', 'TG'),
        ),
        array(
            'name' => 'CFP Franc',
            'alpha3' => 'XPF',
            'numeric' => '953',
            'exp' => 0,
            'country' => array('NC', 'PF', 'WF',),
        ),
        array(
            'name' => 'Yemeni Rial',
            'alpha3' => 'YER',
            'numeric' => '886',
            'exp' => 2,
            'country' => 'YE',
        ),
        array(
            'name' => 'South African Rand',
            'alpha3' => 'ZAR',
            'numeric' => '710',
            'exp' => 2,
            'country' => array('NA', 'LS', 'SZ', 'ZA', 'ZW'),
        ),
        array(
            'name' => 'Zambian Kwacha',
            'alpha3' => 'ZMW',
            'numeric' => '967',
            'exp' => 2,
            'country' => 'ZM',
        ),
    );
}
