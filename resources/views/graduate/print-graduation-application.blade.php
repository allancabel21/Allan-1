@extends('layouts.dashboard')

@section('title', 'Print Graduation Application Form')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="p-4 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                <i class="fas fa-print text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-display font-bold text-gradient mb-2">Print Graduation Application Form</h1>
                <p class="text-lg text-gray-600 font-body">Download and print this form to fill out manually and submit to the registrar's office.</p>
            </div>
        </div>
    </div>

    <!-- Print Instructions -->
    <div class="card-enhanced p-6 mb-8 bg-blue-50 border border-blue-200">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
            <div>
                <h3 class="text-lg font-display font-bold text-blue-800 mb-2">Print Instructions</h3>
                <ul class="text-blue-700 font-body space-y-1">
                    <li>• Click the "Print Form" button below to open the printable version</li>
                    <li>• Use your browser's print function (Ctrl+P) to print the form</li>
                    <li>• Fill out the form completely with black ink</li>
                    <li>• Submit the completed form to the Registrar's Office</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="text-center mb-8">
        <button onclick="printForm()" class="btn-primary px-8 py-4 text-lg font-display font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-print mr-3"></i>Print Form
        </button>
    </div>

    <!-- Printable Form -->
    <div id="printableForm" class="bg-white p-4 shadow-xl" style="display: none; font-size: 12px; line-height: 1.2;">
        <!-- University Header -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-3 mb-4 border border-blue-200">
            <div class="flex justify-between items-start">
                <!-- University Logo and Name -->
                <div class="flex-1">
                    <div class="flex items-start">
                        <div class="mr-4 flex-shrink-0">
                            <img src="{{ asset('images/hdustp.jpg') }}" 
                                 alt="USTP Logo" 
                                 class="h-16 w-auto object-contain">
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <h2 class="text-lg font-bold text-gray-800 leading-tight mb-0">UNIVERSITY OF SCIENCE AND</h2>
                                <h3 class="text-lg font-bold text-gray-800 leading-tight mb-0">TECHNOLOGY</h3>
                                <h4 class="text-lg font-bold text-gray-800 leading-tight">OF SOUTHERN PHILIPPINES</h4>
                            </div>
                            <p class="text-xs text-gray-600 font-body">Alubijid | Cagayan de Oro | Claveria | Jasaan | Oroquieta | Panaon</p>
                        </div>
                    </div>
                </div>
                
                <!-- Document Control -->
                <div class="ml-4 flex-shrink-0">
                    <div class="bg-gradient-to-b from-blue-600 to-blue-800 text-white px-3 py-2 text-xs font-bold text-center rounded-t-lg">
                        Document Code No. FM-USTP-RGTR-08.1
                    </div>
                    <div class="bg-white border border-gray-300 rounded-b-lg p-2 text-xs">
                        <table class="w-full">
                            <thead>
                                <tr class="font-bold text-gray-800">
                                    <th class="text-center border-r border-gray-300 pb-0">Rev. No.</th>
                                    <th class="text-center border-r border-gray-300 pb-0">Effective Date</th>
                                    <th class="text-center pb-0">Page No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700">
                                    <td class="text-center border-r border-gray-300 pt-0">00</td>
                                    <td class="text-center border-r border-gray-300 pt-0">10.01.21</td>
                                    <td class="text-center pt-0">1 of 1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date -->
        <div class="text-right mb-3">
            <span class="text-xs font-display font-semibold text-gray-700">Date: _________________</span>
        </div>

        <!-- Main Title -->
        <div class="text-center mb-4">
            <h2 class="text-xl font-display font-bold text-gray-900 uppercase">Application for Graduation</h2>
        </div>

        <!-- Recipient -->
        <div class="text-right mb-3">
            <p class="text-gray-700 font-body text-sm">The Registrar</p>
            <p class="text-gray-700 font-body text-sm">This University</p>
        </div>

        <!-- Application Body -->
        <div class="space-y-3 mb-4">
            <p class="text-gray-700 font-body text-sm">Sir/Madam:</p>
            
            <div class="space-y-2">
                <p class="text-gray-700 font-body text-sm leading-tight">
                    I have the honor to apply for graduation and conferment of the
                </p>
                
                <div class="flex items-center space-x-6 mb-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-1 w-3 h-3"> 
                        <span class="text-gray-700 font-body text-sm">Degree of</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-1 w-3 h-3"> 
                        <span class="text-gray-700 font-body text-sm">Diploma in</span>
                    </label>
                </div>
                
                <div class="space-y-2">
                    <p class="text-gray-700 font-body text-sm leading-tight">
                        major in _________________________________ at the Commencement Exercises of the University of Science and Technology of Southern Philippines, 
                        (_________________) on _________________ for having satisfactorily completed all the requirements prescribed by the 
                        (College, Unit, or Department of _________________) of USTP, (_________________). 
                        The following are my last subject load which I took 
                        <select class="border-b border-gray-400 bg-transparent text-sm">
                            <option value="">_________________</option>
                            <option value="semester">Semester</option>
                            <option value="summer">Summer</option>
                        </select>, school year _________________.
                    </p>
                </div>
            </div>
        </div>

        <!-- Subject Load Table -->
        <div class="mb-4">
            <h4 class="text-sm font-display font-semibold text-gray-800 mb-2">Last Subject Load</h4>
            <table class="min-w-full border border-gray-400 text-xs">
                <thead>
                    <tr>
                        <th class="border border-gray-400 px-2 py-1 text-left font-display font-semibold">Subject Code</th>
                        <th class="border border-gray-400 px-2 py-1 text-left font-display font-semibold">Descriptive Title</th>
                        <th class="border border-gray-400 px-2 py-1 text-left font-display font-semibold">Units</th>
                        <th class="border border-gray-400 px-2 py-1 text-left font-display font-semibold">Name of Instructor</th>
                        <th class="border border-gray-400 px-2 py-1 text-left font-display font-semibold">Instructor's Signature</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td class="border border-gray-400 px-2 py-1 h-6"></td>
                            <td class="border border-gray-400 px-2 py-1 h-6"></td>
                            <td class="border border-gray-400 px-2 py-1 h-6"></td>
                            <td class="border border-gray-400 px-2 py-1 h-6"></td>
                            <td class="border border-gray-400 px-2 py-1 h-6"></td>
                        </tr>
                    @endfor
                    <tr class="font-semibold">
                        <td colspan="2" class="border border-gray-400 px-2 py-1 text-right">Total Units</td>
                        <td class="border border-gray-400 px-2 py-1"></td>
                        <td class="border border-gray-400 px-2 py-1"></td>
                        <td class="border border-gray-400 px-2 py-1"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Diploma Information -->
        <div class="mb-4">
            <h4 class="text-sm font-display font-bold text-gray-900 mb-2 uppercase text-center">My Name to be Printed on the Diploma Will Be as Follows:</h4>
            <div class="space-y-2">
                <div>
                    <div class="border-b border-gray-400 h-6"></div>
                    <p class="text-xs text-gray-500 mt-0">(Name)</p>
                </div>
                <div>
                    <div class="border-b border-gray-400 h-6"></div>
                    <p class="text-xs text-gray-500 mt-0">(Home/Mailing Address)</p>
                </div>
                <div>
                    <div class="border-b border-gray-400 h-6"></div>
                    <p class="text-xs text-gray-500 mt-0">(Contact Number)</p>
                </div>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="mb-4">
            <div class="flex justify-between items-end">
                <div class="text-center">
                    <p class="mb-1 text-sm">Very respectfully yours,</p>
                    <div class="border-b border-gray-400 w-48 h-6"></div>
                    <p class="text-xs text-gray-600 mt-0">Signature of Applicant</p>
                </div>
                <div>
                    <!-- Placeholder for approval signatures -->
                </div>
            </div>
        </div>

        <!-- Approval Section -->
        <div class="mt-3">
            <div class="flex justify-between">
                <div class="text-center">
                    <p class="mb-1 font-display font-semibold text-sm">Recommending Approval:</p>
                    <div class="border-b border-gray-400 w-36 h-6"></div>
                    <p class="text-xs text-gray-600 mt-0">Department Chair/Unit Coordinator</p>
                </div>
                <div class="text-center">
                    <p class="mb-1 font-display font-semibold text-sm">Approved:</p>
                    <div class="border-b border-gray-400 w-36 h-6"></div>
                    <p class="text-xs text-gray-600 mt-0">Dean/Academic Head/Campus Director</p>
                </div>
                <div class="text-center">
                    <p class="mb-1 font-display font-semibold text-sm">Approved:</p>
                    <div class="border-b border-gray-400 w-36 h-6"></div>
                    <p class="text-xs text-gray-600 mt-0">University Registrar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function printForm() {
    // Show the printable form
    document.getElementById('printableForm').style.display = 'block';
    
    // Hide other elements for printing
    const elementsToHide = document.querySelectorAll('.mb-8, .text-center, .card-enhanced');
    elementsToHide.forEach(el => {
        if (!el.closest('#printableForm')) {
            el.style.display = 'none';
        }
    });
    
    // Print the form
    window.print();
    
    // Restore elements after printing
    elementsToHide.forEach(el => {
        el.style.display = '';
    });
    
    // Hide the printable form again
    document.getElementById('printableForm').style.display = 'none';
}

// Add print-specific styles
const printStyles = `
    @media print {
        body * {
            visibility: hidden;
        }
        #printableForm, #printableForm * {
            visibility: visible;
        }
        #printableForm {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            font-size: 11px !important;
            line-height: 1.1 !important;
            padding: 0.4in 0.5in 0.2in 0.5in !important;
            margin: 0 !important;
            box-sizing: border-box;
        }
        .no-print {
            display: none !important;
        }
        @page {
            margin: 0.4in 0.5in 0.2in 0.5in;
            size: A4;
        }
        table {
            page-break-inside: avoid;
        }
        .mb-4, .mb-3, .mb-2 {
            margin-bottom: 0.25rem !important;
        }
        .mt-3, .mt-6 {
            margin-top: 0.25rem !important;
        }
        h2, h3, h4 {
            margin-bottom: 0.125rem !important;
        }
        p {
            margin-bottom: 0.125rem !important;
        }
        div {
            margin-bottom: 0.125rem !important;
        }
    }
`;

const styleSheet = document.createElement("style");
styleSheet.type = "text/css";
styleSheet.innerText = printStyles;
document.head.appendChild(styleSheet);
</script>
@endsection
