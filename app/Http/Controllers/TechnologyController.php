<?
namespace App\Http\Controllers;

use App\Models\Tech;
use Inertia\Inertia;

class TechnologyController extends Controller
{
    public function index()
    {
        // Retrieve all technologies
        $technologies = Tech::all();

        return Inertia::render('Technology/Index', [
            'technologies' => $technologies,
        ]);
    }
}
?>