use App\Models\Acara;
use Illuminate\Http\Request;

public function update(Request $request, $id)
{
    $request->validate([
        'tanggal' => 'required|date',
        'status' => 'required|in:upcoming,ongoing,completed',
    ]);

    $acara = Acara::findOrFail($id);

    $acara->update([
        'tanggal' => $request->tanggal,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Booking berhasil diperbarui.');
}