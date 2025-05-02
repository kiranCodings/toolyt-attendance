<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search Form -->
            <div class="bg-white p-6 rounded shadow-sm mb-4">
                <form method="GET" action="{{ route('attendance.search') }}">
                    <div class="mb-4">
                        <label for="query" class="block text-sm font-medium text-gray-700">
                            Search by Email or Phone
                        </label>
                        <input type="text" id="query" name="query" value="{{ old('query',  request('query', 'ligi@toolyt.com')) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter email or phone number..." required>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Search</button>
                </form>
            </div>

            <!-- Results -->
            @if (isset($attendances) && $attendances->isNotEmpty())
                @php
                    $firstAttendance = $attendances->first();
                    $isInternal = $firstAttendance->internal_user_id !== null;
                    $user = $isInternal ? $firstAttendance->internalUser : $firstAttendance->externalUser;
                    $totalSeconds = 0;
                @endphp

                <!-- User Details -->
                <div class="bg-white p-4 rounded shadow-sm mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        User Details ({{ $isInternal ? 'Internal' : 'External' }})
                    </h3>
                    <ul class="text-gray-700">
                        <li><strong>{{ $isInternal ? 'User Name' : 'User ID' }}:</strong>
                            {{ $isInternal ? $user->username : ($user->user_id ?? 'N/A') }}</li>
                        <li><strong>{{ $isInternal ? 'Email' : 'Phone' }}:</strong>
                            {{ $isInternal ? $user->email : $user->phone_2 }}</li>
                        @if (!$isInternal)
                            <li><strong>Address:</strong> {{ $user->address }}</li>
                            <li><strong>DOB:</strong> {{ $user->dob }}</li>
                        @else
                            <li><strong>Phone:</strong> {{ $user->phone }}</li>
                        @endif
                    </ul>
                </div>

                <!-- Attendance Table -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Attendance Records</h3>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Login Time</th>
                                <th class="border px-4 py-2">Logout Time</th>
                                <th class="border px-4 py-2">Total Logged Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            @php
                            $diffInSeconds = ($attendance->login_time && $attendance->logout_time)
                                ? $attendance->login_time->diffInSeconds($attendance->logout_time)
                                : 0;
                            $totalSeconds += $diffInSeconds;
                        @endphp
                                <tr>
                                    <td class="border px-4 py-2">{{ $attendance->login_time }}</td>
                                    <td class="border px-4 py-2">{{ $attendance->logout_time }}</td>
                                    <td class="border px-4 py-2">{{ gmdate('H:i', $diffInSeconds) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @php
                                $totalHours = floor($totalSeconds / 3600);
                                $totalMinutes = floor(($totalSeconds % 3600) / 60);
                            @endphp
                            <tr>
                                <td colspan="2" class="border px-4 py-2 text-right font-semibold">Total Days:</td>
                                <td class="border px-4 py-2">{{ count($attendances) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border px-4 py-2 text-right font-semibold">Total Time:</td>
                                <td class="border px-4 py-2">{{ $totalHours }}h {{ $totalMinutes }}m</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @elseif(request('query'))
                <div class="bg-white p-6 mt-4 rounded shadow text-red-600">
                    No attendance records found for the given input.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
