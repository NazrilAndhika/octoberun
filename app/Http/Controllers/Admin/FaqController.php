<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === 'active' ? true : false);
        }

        $faqs = $query->orderBy('order')->paginate(10)->appends($request->query());

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
            'order'    => 'nullable|integer|min:0',
        ]);

        // Auto-assign order jika kosong
        $order = $request->order ?? (Faq::max('order') + 1);

        Faq::create([
            'question'  => $request->question,
            'answer'    => $request->answer,
            'order'     => $order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.settings', ['tab' => 'faq'])->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
            'order'    => 'nullable|integer|min:0',
        ]);

        $faq->update([
            'question'  => $request->question,
            'answer'    => $request->answer,
            'order'     => $request->order ?? $faq->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.settings', ['tab' => 'faq'])->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.settings', ['tab' => 'faq'])->with('success', 'FAQ berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update(['is_active' => !$faq->is_active]);
        return back()->with('success', 'Status FAQ berhasil diubah!');
    }
}
