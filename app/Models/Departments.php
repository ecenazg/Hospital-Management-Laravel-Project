<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $fillable = ['id', 'name', 'description'];
    
    // Relationships
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
