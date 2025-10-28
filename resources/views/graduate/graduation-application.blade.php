@extends('layouts.dashboard')

@section('title', 'Application for Graduation')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="p-4 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-display font-bold text-gradient mb-2">Application for Graduation</h1>
                <p class="text-lg text-gray-600 font-body">Submit your graduation application to the University Registrar</p>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-sm" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <div>
                    <strong class="font-display font-bold">Application Submitted Successfully!</strong>
                    <span class="block sm:inline font-body">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-sm" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                <div>
                    <strong class="font-display font-bold">Error</strong>
                    <span class="block sm:inline font-body">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-sm" role="alert">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3 mt-1"></i>
                <div>
                    <strong class="font-display font-bold">Validation Error!</strong>
                    <ul class="mt-2 list-disc list-inside font-body">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Print Option -->
    <div class="card-enhanced p-6 mb-8 bg-blue-50 border border-blue-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-3 bg-blue-600 rounded-xl mr-4">
                    <i class="fas fa-print text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-display font-bold text-blue-800">Need a Physical Copy?</h3>
                    <p class="text-blue-700 font-body">Download and print the form to fill out manually and submit to the registrar's office.</p>
                </div>
            </div>
            <a href="{{ route('graduate.graduation-application.print') }}" 
               class="btn-primary px-6 py-3 font-display font-semibold">
                <i class="fas fa-download mr-2"></i>Print Form
            </a>
        </div>
    </div>

    <!-- Application Form -->
    <div class="card-enhanced p-8 shadow-xl">
        <form method="POST" action="{{ route('graduate.graduation-application.store') }}" class="space-y-8">
            @csrf

            <!-- University Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-blue-100">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">
                    <!-- University Logo and Name -->
                    <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start mb-4">
                        <div class="mr-6">
                            <img src="{{ asset('images/hdustp.jpg') }}" alt="USTP Logo" class="h-20 w-auto object-contain">
                        </div>
                        <div class="text-left flex-1">
                            <h2 class="text-xl font-display font-bold text-gray-800 leading-tight mb-1">UNIVERSITY OF SCIENCE AND</h2>
                            <h3 class="text-xl font-display font-bold text-gray-800 leading-tight mb-1">TECHNOLOGY</h3>
                            <h4 class="text-xl font-display font-bold text-gray-800 leading-tight">OF SOUTHERN PHILIPPINES</h4>
                            <p class="text-sm text-gray-600 font-body mt-2">Alubijid | Cagayan de Oro | Claveria | Jasaan | Oroquieta | Panaon</p>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Document Control -->
                    <div class="text-center lg:text-right">
                        <div class="bg-gradient-to-r from-blue-800 to-blue-900 text-white px-6 py-3 text-sm font-display font-bold rounded-t-xl shadow-lg">
                            Document Code No. FM-USTP-RGTR-08.1
                        </div>
                        <div class="bg-white border-2 border-blue-200 rounded-b-xl shadow-lg overflow-hidden">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="border-r border-gray-200 px-4 py-2 font-display font-semibold text-gray-700">Rev. No.</th>
                                        <th class="border-r border-gray-200 px-4 py-2 font-display font-semibold text-gray-700">Effective Date</th>
                                        <th class="px-4 py-2 font-display font-semibold text-gray-700">Page No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-r border-gray-200 px-4 py-2 font-body text-gray-600">00</td>
                                        <td class="border-r border-gray-200 px-4 py-2 font-body text-gray-600">10.01.21</td>
                                        <td class="px-4 py-2 font-body text-gray-600">1 of 1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date Section -->
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="flex items-center space-x-4">
                    <label class="text-lg font-display font-semibold text-gray-700">Application Date:</label>
                    <input type="date" name="application_date" value="{{ date('Y-m-d') }}" required
                           class="input-enhanced flex-1 max-w-xs text-lg">
                </div>
            </div>

            <!-- Main Title -->
            <div class="text-center py-6">
                <h2 class="text-4xl font-display font-bold text-gray-900 uppercase tracking-wide">Application for Graduation</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Recipient -->
            <div class="text-right bg-gray-50 rounded-xl p-6">
                <p class="text-lg text-gray-700 font-body">The Registrar</p>
                <p class="text-lg text-gray-700 font-body">This University</p>
            </div>

            <!-- Application Body -->
            <div class="space-y-8">
                <div class="bg-white border-l-4 border-blue-500 pl-6 py-4">
                    <p class="text-lg text-gray-700 font-body">Sir/Madam:</p>
                </div>
                
                <div class="space-y-6">
                    <p class="text-lg text-gray-700 font-body leading-relaxed">
                        I have the honor to apply for graduation and conferment of the
                    </p>
                    
                    <!-- Application Type Selection -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-8">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="application_type" value="degree" required 
                                           class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded-full focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-3 text-lg text-gray-700 font-body font-medium">Degree of</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="application_type" value="diploma" required 
                                           class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded-full focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-3 text-lg text-gray-700 font-body font-medium">Diploma in</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Major in:</label>
                            <input type="text" name="major_in" placeholder="Enter your major field of study"
                                   class="input-enhanced w-full max-w-md text-lg">
                        </div>
                    </div>
                    
                    <!-- Campus and Details -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-lg text-gray-700 font-body leading-relaxed">
                                at the Commencement Exercises of the University of Science and Technology of Southern Philippines, 
                                <input type="text" name="campus" placeholder="Campus" required
                                       class="input-enhanced inline-block w-40 mx-2 text-lg font-medium"> on 
                                <input type="date" name="commencement_date" required
                                       class="input-enhanced inline-block w-48 mx-2 text-lg"> for having satisfactorily completed all the requirements prescribed by the 
                                <input type="text" name="college_unit_department" placeholder="College/Unit/Department" required
                                       class="input-enhanced inline-block w-56 mx-2 text-lg font-medium"> of USTP, 
                                <input type="text" name="city_province" placeholder="City/Province" required
                                       class="input-enhanced inline-block w-40 mx-2 text-lg font-medium">.
                            </p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-lg text-gray-700 font-body leading-relaxed">
                                The following are my last subject load which I took 
                                <select name="last_semester" required class="input-enhanced inline-block w-40 mx-2 text-lg">
                                    <option value="">Select</option>
                                    <option value="semester">Semester</option>
                                    <option value="summer">Summer</option>
                                </select>, school year 
                                <input type="text" name="school_year" placeholder="e.g., 2023-2024" required
                                       class="input-enhanced inline-block w-40 mx-2 text-lg font-medium">.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject Load Table -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900">Last Subject Load</h3>
                </div>
                
                <div class="table-enhanced overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="text-left py-4 px-6 font-display font-semibold text-gray-700">Subject Code</th>
                                <th class="text-left py-4 px-6 font-display font-semibold text-gray-700">Descriptive Title</th>
                                <th class="text-left py-4 px-6 font-display font-semibold text-gray-700">Units</th>
                                <th class="text-left py-4 px-6 font-display font-semibold text-gray-700">Name of Instructor</th>
                                <th class="text-left py-4 px-6 font-display font-semibold text-gray-700">Instructor's Signature</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-6">
                                        <input type="text" name="subjects[{{ $i }}][code]" 
                                               class="input-enhanced w-full text-lg" 
                                               value="{{ old('subjects.'.$i.'.code') }}">
                                    </td>
                                    <td class="py-4 px-6">
                                        <input type="text" name="subjects[{{ $i }}][title]" 
                                               class="input-enhanced w-full text-lg" 
                                               value="{{ old('subjects.'.$i.'.title') }}">
                                    </td>
                                    <td class="py-4 px-6">
                                        <input type="number" step="0.1" name="subjects[{{ $i }}][units]" 
                                               class="input-enhanced w-full text-lg calculate-units" 
                                               value="{{ old('subjects.'.$i.'.units') }}">
                                    </td>
                                    <td class="py-4 px-6">
                                        <input type="text" name="subjects[{{ $i }}][instructor]" 
                                               class="input-enhanced w-full text-lg" 
                                               value="{{ old('subjects.'.$i.'.instructor') }}">
                                    </td>
                                    <td class="py-4 px-6">
                                        <input type="text" name="subjects[{{ $i }}][signature]" 
                                               class="input-enhanced w-full text-lg" 
                                               value="{{ old('subjects.'.$i.'.signature') }}">
                                    </td>
                                </tr>
                            @endfor
                            <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 font-semibold">
                                <td colspan="2" class="py-4 px-6 text-right font-display font-bold text-gray-700">Total Units</td>
                                <td class="py-4 px-6">
                                    <input type="number" step="0.1" id="total_units" name="total_units" 
                                           class="input-enhanced w-full text-lg font-bold" 
                                           value="{{ old('total_units', 0) }}" readonly required>
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" id="total_instructor" name="total_instructor" 
                                           class="input-enhanced w-full text-lg" 
                                           value="{{ old('total_instructor') }}">
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" id="total_signature" name="total_signature" 
                                           class="input-enhanced w-full text-lg" 
                                           value="{{ old('total_signature') }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Diploma Information -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg">
                        <i class="fas fa-certificate text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900">Diploma Information</h3>
                </div>
                
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-6 border border-purple-200">
                    <h4 class="text-xl font-display font-bold text-gray-900 mb-6 uppercase">My Name to be Printed on the Diploma Will Be as Follows:</h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="diploma_name" placeholder="Enter your full name as it should appear on the diploma"
                                   class="input-enhanced w-full text-lg" 
                                   value="{{ old('diploma_name', trim(($graduate->first_name ?? '') . ' ' . ($graduate->middle_name ?? '') . ' ' . ($graduate->last_name ?? '') . ' ' . ($graduate->extension ?? ''))) }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Home/Mailing Address</label>
                            <input type="text" name="diploma_address" placeholder="Enter your complete address"
                                   class="input-enhanced w-full text-lg" 
                                   value="{{ old('diploma_address', $graduate->present_address ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Contact Number</label>
                            <input type="text" name="diploma_contact" placeholder="Enter your contact number"
                                   class="input-enhanced w-full text-lg" 
                                   value="{{ old('diploma_contact', $graduate->contact_number ?? '') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="bg-gray-50 rounded-xl p-8">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-end space-y-6 lg:space-y-0">
                    <div class="text-center lg:text-left">
                        <p class="text-lg text-gray-700 font-body mb-4">Very respectfully yours,</p>
                        <div class="border-b-2 border-gray-400 w-64 mx-auto lg:mx-0"></div>
                        <input type="text" class="input-enhanced w-64 text-center text-lg font-semibold mt-2" 
                               value="{{ trim(($graduate->first_name ?? '') . ' ' . ($graduate->middle_name ?? '') . ' ' . ($graduate->last_name ?? '') . ' ' . ($graduate->extension ?? '')) }}" readonly>
                        <p class="text-sm text-gray-600 font-body mt-2">Signature of Applicant</p>
                    </div>
                    <div>
                        <!-- Placeholder for approval signatures -->
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center pt-8">
                <button type="submit" class="btn-primary px-12 py-4 text-lg font-display font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-3"></i>Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotalUnits() {
            let totalUnits = 0;
            document.querySelectorAll('.calculate-units').forEach(function(input) {
                const units = parseFloat(input.value);
                if (!isNaN(units)) {
                    totalUnits += units;
                }
            });
            document.getElementById('total_units').value = totalUnits.toFixed(1);
        }

        document.querySelectorAll('.calculate-units').forEach(function(input) {
            input.addEventListener('input', calculateTotalUnits);
        });

        calculateTotalUnits(); // Calculate on page load
    });
</script>
@endsection