1. Lépés: Adatbázis Struktúra Létrehozása
Először is hozzuk létre az adatbázis táblákat, a
melyek szükségesek a célpontok és a közlekedési 
eszközök tárolásához, valamint az utazási időpontok és árak tárolásához.

Migrációk létrehozása
Hozzunk létre migrációkat a szükséges táblákhoz:

bash
Copy code
php artisan make:migration create_destinations_table
php artisan make:migration create_transportations_table
php artisan make:migration create_trips_table
php artisan make:migration create_trip_dates_table
Nyissuk meg és szerkesszük a migrációs fájlokat.

create_destinations_table:

php
Copy code
public function up()
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('destinations');
}
create_transportations_table:

php
Copy code
public function up()
{
    Schema::create('transportations', function (Blueprint $table) {
        $table->id();
        $table->string('type');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('transportations');
}
create_trips_table:

php
Copy code
public function up()
{
    Schema::create('trips', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destination_id')->constrained()->onDelete('cascade');
        $table->foreignId('transportation_id')->constrained()->onDelete('cascade');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('trips');
}
create_trip_dates_table:

php
Copy code
public function up()
{
    Schema::create('trip_dates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trip_id')->constrained()->onDelete('cascade');
        $table->date('date');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('trip_dates');
}
Ezután futtassuk a migrációkat:

bash
Copy code
php artisan migrate


2. Lépés: Modellek Létrehozása
Hozzuk létre a szükséges modelleket:

bash
Copy code
php artisan make:model Destination
php artisan make:model Transportation
php artisan make:model Trip
php artisan make:model TripDate


Modellek beállítása
Destination.php:

php
Copy code
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
Transportation.php:

php
Copy code
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
Trip.php:

php
Copy code
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'transportation_id', 'price'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function tripDates()
    {
        return $this->hasMany(TripDate::class);
    }
}
TripDate.php:

php
Copy code
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDate extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'date'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
3. Lépés: Factory-k Létrehozása
Hozzuk létre a factory-kat az adatbázis feltöltéséhez:

bash
Copy code
php artisan make:factory DestinationFactory --model=Destination
php artisan make:factory TransportationFactory --model=Transportation
php artisan make:factory TripFactory --model=Trip
php artisan make:factory TripDateFactory --model=TripDate


Factory-k beállítása
DestinationFactory.php:

php
Copy code
namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
        ];
    }
}
TransportationFactory.php:

php
Copy code
namespace Database\Factories;

use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportationFactory extends Factory
{
    protected $model = Transportation::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['auto', 'busz', 'repulo']),
        ];
    }
}
TripFactory.php:

php
Copy code
namespace Database\Factories;

use App\Models\Trip;
use App\Models\Destination;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'destination_id' => Destination::factory(),
            'transportation_id' => Transportation::factory(),
            'price' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}
TripDateFactory.php:

php
Copy code
namespace Database\Factories;

use App\Models\TripDate;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripDateFactory extends Factory
{
    protected $model = TripDate::class;

    public function definition()
    {
        return [
            'trip_id' => Trip::factory(),
            'date' => $this->faker->date(),
        ];
    }
}
4. Lépés: Adatbázis feltöltése Seederek segítségével
Hozzuk létre a seeder fájlokat:

bash
Copy code
php artisan make:seeder DatabaseSeeder
php artisan make:seeder DestinationSeeder
DestinationSeeder.php:

php
Copy code
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::factory()
            ->count(10)
            ->hasTrips(3)
            ->create();
    }
}
DatabaseSeeder.php:

php
Copy code
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DestinationSeeder::class);
    }
}
Futtassuk a seeder-t:

bash
Copy code
php artisan db:seed
5. Lépés: Routing és Kontrollerek létrehozása
Hozzunk létre egy kontrollert az utazások kezeléséhez:

bash
Copy code
php artisan make:controller TripController
TripController.php:

php
Copy code
namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('trips.transportation')->paginate(10);
        return view('trips.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        $destination->load('trips.tripDates');
        return view('trips.show', compact('destination'));
    }
}
6. Lépés: Útvonalak beállítása
Adjunk hozzá útvonalakat a routes/web.php fájlhoz:

php
Copy code
use App\Http\Controllers\TripController;

Route::get('/', [TripController::class, 'index']);
Route::get('/destinations/{destination}', [TripController::class, 'show'])->name('destinations.show');
7. Lépés: Nézetek létrehozása
Hozzuk létre a nézeteket a resources/views/trips könyvtárban.

index.blade.php:

html
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>Világraszóló Utazási Iroda</title>
</head>
<body>
    <h1>Célpontok</h1>
    <ul>
        @foreach ($destinations as $destination)
            <li>
                <a href="{{ route('destinations.show', $destination->id) }}">{{ $destination->name }}</a>
                <ul>
                    @foreach ($destination->trips as $trip)
                        <li>{{ $trip->transportation->type }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    {{ $destinations->links() }}
</body>
</html>
show.blade.php:

docker exec -it --user=root container-name chmod -R 777 /var/www/storage

html
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>{{ $destination->name }}</title>
</head>
<body>
    <h1>{{ $destination->name }}</h1>
    <h2>Indulási időpontok és árak</h2>
    <ul>
        @forelse ($destination->trips as $trip)
            <li>
                <strong>Közlekedési eszköz:</strong> {{ $trip->transportation->type }}
                <ul>
                    @forelse ($trip->tripDates as $date)
                        <li>{{ $date->date }} - {{ $trip->price }} Ft</li>
                    @empty
                        <li>Nincs elérhető indulási időpont.</li>
                    @endforelse
                </ul>
            </li>
        @empty
            <li>Nincsenek elérhető utazások.</li>
        @endforelse
    </ul>
    <a href="{{ url('/') }}">Vissza a főoldalra</a>
</body>
</html>



Rendben, hozzáadunk seedelést az utazási időpontokhoz is. 
Ehhez módosítjuk a TripFactory-t, 
hogy tartalmazzon utazási időpontokat, 
és létrehozunk néhány utazási időpontot a DestinationSeeder-ben.

1. Lépés: TripFactory módosítása
Módosítsuk a TripFactory-t, hogy az utazási időpontokat is legenerálja:

TripFactory.php:

php
Copy code
use App\Models\Trip;
use App\Models\Destination;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'destination_id' => Destination::factory(),
            'transportation_id' => Transportation::factory(),
            'price' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Trip $trip) {
            TripDate::factory()->count(3)->create(['trip_id' => $trip->id]);
        });
    }
}
2. Lépés: TripDateFactory létrehozása
Hozzuk létre a TripDateFactory-t, ha még nem létezik:

bash
Copy code
php artisan make:factory TripDateFactory --model=TripDate
TripDateFactory.php:

php
Copy code
use App\Models\TripDate;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripDateFactory extends Factory
{
    protected $model = TripDate::class;

    public function definition()
    {
        return [
            'trip_id' => Trip::factory(),
            'date' => $this->faker->date(),
        ];
    }
}
3. Lépés: DestinationSeeder frissítése
Frissítsük a DestinationSeeder-t, hogy a célpontokhoz kapcsolódó utazásokat és utazási időpontokat is generálja:

DestinationSeeder.php:

php
Copy code
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Trip;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::factory()
            ->count(10)
            ->has(Trip::factory()->count(3))
            ->create();
    }
}
4. Lépés: Seeder futtatása
Futtassuk újra a seeder-t, hogy az adatbázis feltöltődjön a szükséges adatokkal:

bash
Copy code
php artisan db:seed