<div x-data="{ section: '', filter: 'all',selected: null, rejecting: false, reason: ''}">
    <div x-show="section !== 'transaksi'">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">Transaction</span>
            <span class="text-gray-500">Manage All Your Transaction</span>
        </div>

        <div class="flex gap-4 border-b mb-4 text-sm">
            <template x-for="f in ['all', 'pending', 'paid', 'rejected', 'unpaid', 'expired']" :key="f">
                <button
                    type="button"
                    @click="filter = f"
                    class="pb-2 -mb-px capitalize"
                    :class="filter === f ? 'border-b-2 border-black font-medium' : 'text-gray-500'"
                    x-text="f"> </button>
            </template>
        </div>

        <div class="border rounded overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-2 font-medium">ID</th>
                    <th class="px-4 py-2 font-medium">Customer</th>
                    <th class="px-4 py-2 font-medium">Package</th>
                    <th class="px-4 py-2 font-medium">Price</th>
                    <th class="px-4 py-2 font-medium">Date</th>
                    <th class="px-4 py-2 font-medium">Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr class="border-t cursor-pointer hover:bg-gray-50"
                        x-show="filter === 'all' || filter === '{{ $transaksi->status }}'"
                        @click="
                                selected = '{{ $transaksi->trans_id }}';
                                rejecting = false;
                                reason = '';
                                section = 'transaksi'
                            " >
                        <td class="px-4 py-3">
                            {{ $transaksi->trans_id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $transaksi->customer->name}}
                        </td>

                        <td class="px-4 py-3">
                            {{ $transaksi->paket->judul}}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap">
                            Rp {{ number_format($transaksi->paket->harga ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $transaksi->created_at?->format('d M Y, H:i') }}
                        </td>

                        <td class="px-4 py-3">
                            @if ($transaksi->status === 'pending')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border text-yellow-700 bg-yellow-50 border-yellow-500">
                                        pending
                                    </span>
                            @elseif ($transaksi->status === 'paid')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border text-green-700 bg-green-50 border-teal-500 bg-green-50">
                                        paid
                                    </span>
                            @elseif ($transaksi->status === 'rejected')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border text-red-700 border-red-400 bg-red-50">
                                        rejected
                                    </span>
                            @elseif ($transaksi->status === 'unpaid')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border text-gray-600 border-line-8">
                                        unpaid
                                    </span>
                            @elseif ($transaksi->status === 'expired')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border text-gray-500 border-gray-300 bg-gray-50">
                                        expired
                                    </span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500"
                        x-show="filter !== 'all' && !Array.from($el.parentElement.children).some(row => row.style.display !== 'none' && row !== $el)">

                        No transactions found.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($transaksis as $transaksi)
        <div x-show="section === 'transaksi' && selected === '{{ $transaksi->trans_id }}'" x-cloak>
            <div class="flex items-center">
                <div @click="section = '', selected = null"
                     class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer">
                    <x-lucide-arrow-left class="w-6 h-6" />
                </div>
                <span class="px-1">Back To Transaction</span>
            </div>


            <div class="flex items-center gap-3 mb-4">
                <span class="text-2xl font-semibold">
                    {{ $transaksi->trans_id }}
                </span>

                @if ($transaksi->status === 'pending')
                    <span class="border rounded px-2 py-0.5 text-xs text-yellow-700 bg-yellow-50 border-yellow-500">
                        pending
                    </span>
                @elseif ($transaksi->status === 'paid')
                    <span class="border rounded px-2 py-0.5 text-xs text-green-700 bg-green-50 border-teal-500 bg-green-50">
                        paid
                    </span>
                @elseif ($transaksi->status === 'rejected')
                    <span class="border rounded px-2 py-0.5 text-xs text-red-700 border-red-400 bg-red-50">
                        rejected
                    </span>
                @elseif ($transaksi->status === 'unpaid')
                    <span class="border rounded px-2 py-0.5 text-xs text-gray-600 border-line-8">
                        unpaid
                    </span>
                @elseif ($transaksi->status === 'expired')
                    <span class="border rounded px-2 py-0.5 text-xs text-gray-500 border-gray-300 bg-gray-50">
                        expired
                    </span>
                @endif
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <dl class="text-sm border rounded divide-y h-fit">
                    <div class="flex justify-between px-4 py-3">
                        <dt class="text-gray-500">Customer</dt>
                        <dd>
                            {{ $transaksi->customer->name}}
                        </dd>
                    </div>

                    <div class="flex justify-between px-4 py-3">
                        <dt class="text-gray-500">Package</dt>
                        <dd>
                            {{ $transaksi->paket->judul }}
                        </dd>
                    </div>

                    <div class="flex justify-between px-4 py-3">
                        <dt class="text-gray-500">Amount</dt>
                        <dd>
                            Rp {{ number_format($transaksi->paket->harga ?? 0, 0, ',', '.') }}
                        </dd>
                    </div>

                    <div class="flex justify-between px-4 py-3">
                        <dt class="text-gray-500">Created</dt>
                        <dd>
                            {{ $transaksi->created_at?->format('d M Y, H:i') }}
                        </dd>
                    </div>

                    @if ($transaksi->paid_at)
                        <div class="flex justify-between px-4 py-3">
                            <dt class="text-gray-500">Paid at</dt>
                            <dd>
                                {{ $transaksi->paid_at->format('d M Y, H:i') }}
                            </dd>
                        </div>
                    @endif

                    @if ($transaksi->verified_at)
                        <div class="flex justify-between px-4 py-3">
                            <dt class="text-gray-500">Verified at</dt>
                            <dd>
                                {{ \Carbon\Carbon::parse($transaksi->verified_at)->format('d M Y, H:i') }}
                            </dd>
                        </div>
                    @endif

                    @if ($transaksi->rejection_reason)
                        <div class="px-4 py-3">
                            <dt class="text-gray-500 mb-1">Rejection reason</dt>
                            <dd>
                                {{ $transaksi->rejection_reason }}
                            </dd>
                        </div>
                    @endif
                </dl>

                <div>
                    <div class="text-sm text-gray-500 mb-2">
                        Proof of payment
                    </div>

                    @if ($transaksi->bukti_key)
                        <a
                            href="{{ $transaksi->bukti_key }}"
                            target="_blank"
                            rel="noopener"
                        >
                            <img
                                src="{{ $transaksi->bukti_key }}"
                                alt="Proof of payment"
                                class="border rounded w-full max-h-96 object-contain bg-gray-50"
                            >
                        </a>
                    @else
                        <div class="border border-dashed rounded py-12 text-center text-sm text-gray-500">
                            No proof uploaded yet.
                        </div>
                    @endif

                    @if ($transaksi->status === 'pending')
                        <div class="mt-4">
                            <div
                                class="flex gap-2"
                                x-show="!rejecting"
                            >
                                <form
                                    method="POST"
                                    action="{{ route('transaksi.accept', ['id' => $transaksi->trans_id]) }}"
                                >
                                    @csrf

                                    <button type="submit" class="py-2 px-4 inline-flex items-center  text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus  disabled:opacity-50 disabled:pointer-events-none">
                                        Accept payment
                                    </button>
                                </form>

                                <button type="button" @click="rejecting = true" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-line-5 text-muted-foreground-1 hover:border-line-8 hover:text-foreground focus:outline-hidden focus:border-line-8 focus:text-foreground disabled:opacity-50 disabled:pointer-events-none">
                                    Reject
                                </button>
                            </div>

                            <div x-show="rejecting"
                                class="flex flex-col gap-2">
                                <form method="POST" action="{{ route('transaksi.reject', ['id' => $transaksi->trans_id]) }}"
                                    class="flex flex-col gap-2">
                                    @csrf

                                    <label for="rejection_reason_{{ $transaksi->trans_id }}" class="text-sm text-gray-500">
                                        Reason for rejection
                                    </label>

                                    <input id="rejection_reason_{{ $transaksi->trans_id }}"
                                        name="rejection_reason"
                                        type="text"
                                        maxlength="255"
                                        x-model="reason"
                                        class="border rounded px-3 py-2 text-sm"
                                        placeholder="e.g. Amount does not match"
                                        required>

                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-red-600 text-white text-sm px-4 py-2 rounded">
                                            Reject payment
                                        </button>

                                        <button type="button"
                                                class="border text-sm px-4 py-2 rounded"
                                                @click="rejecting = false; reason = ''">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
