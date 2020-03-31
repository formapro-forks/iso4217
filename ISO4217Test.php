<?php

/**
 * (c) Rob Bast <rob.bast@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Payum\ISO4217\Tests;

use Payum\ISO4217\ISO4217;

class ISO4217Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider invalidAlpha3Provider
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Not a valid alpha3: .*$/
     */
    public function testFindByAlpha3Invalid($alpha3)
    {
        $iso4217 = new ISO4217; 
        
        $iso4217->findByAlpha3($alpha3);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ISO 4217 does not contain: ZZZ
     */
    public function testFindByAlpha3Unknown()
    {
        $iso4217 = new ISO4217;

        $iso4217->findByAlpha3('ZZZ');
    }

    /**
     * @dataProvider alpha3Provider
     */
    public function testFindByAlpha3($alpha3, array $expected)
    {
        $iso4217 = new ISO4217;

        $currency = $iso4217->findByAlpha3($alpha3);

        $this->assertInstanceOf('Payum\ISO4217\Currency', $currency);

        $this->assertEquals($expected['name'], $currency->getName());
        $this->assertEquals($expected['alpha3'], $currency->getAlpha3());
        $this->assertEquals($expected['numeric'], $currency->getNumeric());
        $this->assertEquals($expected['exp'], $currency->getExp());
        $this->assertEquals($expected['country'], $currency->getCountry());
    }

    /**
     * @dataProvider alpha3Provider
     */
    public function testFindByAlpha3MustReturnSameInstance($alpha3, array $expected)
    {
        $iso4217 = new ISO4217;

        $firstCurrency = $iso4217->findByAlpha3($alpha3);
        $secondCurrency = $iso4217->findByAlpha3($alpha3);

        $this->assertInstanceOf('Payum\ISO4217\Currency', $firstCurrency);
        $this->assertInstanceOf('Payum\ISO4217\Currency', $secondCurrency);
        $this->assertSame($firstCurrency, $secondCurrency);
    }

    /**
     * @dataProvider invalidNumericProvider
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Not a valid numeric: .*$/
     */
    public function testFindByNumericInvalid($numeric)
    {
        $iso4217 = new ISO4217;

        $iso4217->findByNumeric($numeric);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage ISO 4217 does not contain: 000
     */
    public function testFindByNumericUnknown()
    {
        $iso4217 = new ISO4217;

        $iso4217->findByNumeric('000');
    }

    /**
     * @dataProvider numericProvider
     */
    public function testFindByNumeric($numeric, array $expected)
    {
        $iso4217 = new ISO4217;

        $currency = $iso4217->findByNumeric($numeric);

        $this->assertInstanceOf('Payum\ISO4217\Currency', $currency);

        $this->assertEquals($expected['name'], $currency->getName());
        $this->assertEquals($expected['alpha3'], $currency->getAlpha3());
        $this->assertEquals($expected['numeric'], $currency->getNumeric());
        $this->assertEquals($expected['exp'], $currency->getExp());
        $this->assertEquals($expected['country'], $currency->getCountry());
    }

    /**
     * @dataProvider numericProvider
     */
    public function testFindByNumericMustReturnSameInstance($numeric, array $expected)
    {
        $iso4217 = new ISO4217;

        $firstCurrency = $iso4217->findByNumeric($numeric);
        $secondCurrency = $iso4217->findByNumeric($numeric);

        $this->assertInstanceOf('Payum\ISO4217\Currency', $firstCurrency);
        $this->assertInstanceOf('Payum\ISO4217\Currency', $secondCurrency);
        $this->assertSame($firstCurrency, $secondCurrency);
    }

    public function testFindAll()
    {
        $iso4217 = new ISO4217;

        $currencies = $iso4217->findAll();

        $this->assertInternalType('array', $currencies);
        $this->assertCount(156, $currencies);

        $this->assertContainsOnly('Payum\ISO4217\Currency', $currencies);
    }

    /**
     * @return array
     */
    public function invalidAlpha3Provider()
    {
        return array(array('ZZ'), array('ZZZZ'), array(12), array(1234));
    }

    /**
     * @return array
     */
    public function alpha3Provider()
    {
        return $this->getCurrencies('alpha3');
    }

    /**
     * @return array
     */
    public function invalidNumericProvider()
    {
        return array(array('00'), array('0000'), array('ZZ'), array('ZZZZ'));
    }

    /**
     * @return array
     */
    public function numericProvider()
    {
        return $this->getCurrencies('numeric');
    }

    /**
     * @return array
     */
    private function getCurrencies($indexedBy)
    {
        $rp = new \ReflectionProperty('Payum\ISO4217\ISO4217', 'rawCurrencies');
        $rp->setAccessible(true);
        $currencies = $rp->getValue('Payum\ISO4217');
        $rp->setAccessible(false);

        return array_reduce(
            $currencies,
            function (array $carry, array $currency) use ($indexedBy) {
                $carry[] = array($currency[$indexedBy], $currency);
                return $carry;
            },
            array()
        );
    }
}
