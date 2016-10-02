<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTests extends TestCase
{
    /**
     * Test the homepage loads with the words
     *
     * @return void
     */
    public function testHomepageLoad()
    {
        $this->visit(env('APP_URL'))
             ->see('Latest electric and hybrid autos for sale');
    }

    /**
     * Test the homepage loads to the default used-cars page
     *
     * @return void
     */
    public function testHomepageToContactLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Autos')
            ->seePageIs(env('APP_URL') . '/used-cars');
    }

    /**
     * Test the homepage loads to the Login page once login link is clicked
     *
     * @return void
     */
    public function testHomepageToLoginLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Login')
            ->seePageIs(env('APP_URL') . '/login');
    }

    /**
     * Test the homepage loads to the Register page once register link is clicked
     *
     * @return void
     */
    public function testHomepageToRegisterLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Create an account')
            ->seePageIs(env('APP_URL') . '/register');
    }

    /**
     * Test the homepage loads to the Terms & Conditions page once terms link is clicked
     *
     * @return void
     */
    public function testHomepageToTermsLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Terms & Conditions')
            ->seePageIs(env('APP_URL') . '/terms');
    }

    /**
     * Test the homepage loads to the Privacy page once privacy link is clicked
     *
     * @return void
     */
    public function testHomepageToPrivacyLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Privacy Policy')
            ->seePageIs(env('APP_URL') . '/privacy-policy');
    }

    /**
     * Test the homepage loads to the Privacy page once privacy link is clicked
     *
     * @return void
     */
    public function testHomepageToTourLoad()
    {
        $this->visit(env('APP_URL'))
            ->click('Cookie Policy')
            ->seePageIs(env('APP_URL') . '/cookie-policy');
    }
}
