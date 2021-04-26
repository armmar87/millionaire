<?php


namespace Unit\App\Http\Controllers;

use App\Http\Controllers\PlayController;
use Mockery;
use Tests\Unit\BaseTestCase;

class PlayControllerTest extends BaseTestCase
{
    private $model;

    protected function mockeryTestSetUp()
    {
        parent::mockeryTestSetUp();
        $this->SUT = Mockery::mock(PlayController::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $this->model = Mockery::mock('overload:App\Models\Play');
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function GIVEN_WHEN_construct()
    {
        $this->constructMocks();

        $this->assertEquals(true, true);
    }

    private function constructMocks()
    {
        $this->SUT->__construct($this->model);
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function GIVEN_WHEN_index_THEN_return_response()
    {
        // GIVEN
        $this->constructMocks();

        Mockery::mock('alias:Illuminate\Support\Facades\Auth')
            ->shouldReceive('id');

        $play = 'play';
        $question = 'question';
        $this->model->shouldReceive('firstOrCreate')
            ->once()
            ->with(Mockery::any())
            ->andReturn($this->model)
            ->shouldReceive('orderBy')
            ->once()
            ->with(Mockery::any(), Mockery::any())
            ->andReturn($this->model)
            ->shouldReceive('first')
            ->andReturn($play);

        $questionMock = Mockery::mock('alias:App\Models\Question');
        $questionMock->shouldReceive('getRandomId')
            ->once()
            ->with(Mockery::any())
            ->andReturn($questionMock);

        $questionMock->shouldReceive('with')
            ->once()
            ->with(Mockery::any())
            ->andReturn($questionMock)
            ->shouldReceive('whereId')
            ->once()
            ->with(Mockery::any())
            ->andReturn($questionMock)
            ->shouldReceive('first')
            ->andReturn($question);

        $expected = compact('play', 'question');

        // WHEN
        $actual = $this->SUT->index();

        // THEN
        $this->assertEquals($expected, $actual);
    }
}
