<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    public function randomUsers()
    {
        $idList = User::select('id')->get();
        $fromId = $idList->random()->id;
        $toId = $idList->where('id', '!=', $fromId)->random()->id;
        return compact('fromId', 'toId');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = $this->randomUsers();
        return [
            'creator_id' => $rand['fromId'],
            'to_user_id' => $rand['toId'],
            'title' => '',
        ];
    }


    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Room $room) {

            Collection::times(10)->each(function ($item) use ($room) {
                $user_id = $room->creator_id;
                $body = $this->faker->text(200);
                $data = compact('user_id', 'body');
                $room->messages()->create($data);
            });
        });
    }
}
