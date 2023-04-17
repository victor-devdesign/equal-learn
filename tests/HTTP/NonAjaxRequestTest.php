<?php

namespace Tests\HTTP;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class NonAjaxRequestTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testRenderLayout()
    {
        $testResponse = $this->call('get', '/');
        $this->assertMatchesRegularExpression('/<html>/', $testResponse->getBody());
    }
}
