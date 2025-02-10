use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('no_penerbangan')->unique();
            $table->foreignId('maskapai_id')->constrained()->onDelete('cascade');
            $table->foreignId('bandara_asal_id')->constrained('bandaras')->onDelete('cascade');
            $table->foreignId('bandara_tujuan_id')->constrained('bandaras')->onDelete('cascade');
            $table->date('date');
            $table->time('boarding_time');
            $table->decimal('harga', 10, 2);
            $table->string('gerbang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
} 