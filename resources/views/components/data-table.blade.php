{{-- 
    Komponen Data Table
    Table dengan styling modern untuk CRUD
--}}
@props([
    'headers' => [],
    'striped' => true,
    'hoverable' => true,
])

<div class="overflow-hidden bg-white rounded-2xl shadow-sm border border-secondary-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <!-- Header -->
            <thead class="bg-secondary-50 border-b border-secondary-200">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y divide-secondary-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <!-- Pagination (optional) -->
    @if(isset($pagination))
        <div class="px-6 py-4 border-t border-secondary-200 bg-secondary-50">
            {{ $pagination }}
        </div>
    @endif
</div>
