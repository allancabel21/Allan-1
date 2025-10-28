@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Graduate Tracer Survey (GTS)</h1>
        <p class="text-gray-600">Complete the comprehensive survey to help us track graduate outcomes and improve our programs.</p>
    </div>

    <!-- Survey Form Card -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Survey Form</h2>
            <p class="text-sm text-gray-600 mt-1">Multi‑step form based on the Graduate Tracer Survey (GTS). Use Next/Back to navigate. Required items have an asterisk (*).</p>
        </div>
        
        <div class="p-6">
            <form method="POST" action="{{ route('graduate.survey.store') }}" id="gts-form">
                @csrf

                <!-- Step Indicators -->
                <div class="flex items-center gap-2 mb-6">
                    <div class="px-3 py-1 rounded bg-blue-600 text-white text-sm" data-step-pill="1">A. General Info</div>
                    <div class="px-3 py-1 rounded bg-gray-200 text-gray-700 text-sm" data-step-pill="2">B. Education</div>
                    <div class="px-3 py-1 rounded bg-gray-200 text-gray-700 text-sm" data-step-pill="3">C. Training</div>
                    <div class="px-3 py-1 rounded bg-gray-200 text-gray-700 text-sm" data-step-pill="4">D. Employment</div>
                    <div class="px-3 py-1 rounded bg-gray-200 text-gray-700 text-sm" data-step-pill="5">E. Others</div>
                </div>

                <!-- STEP 1: A. GENERAL INFORMATION -->
                <div class="step" data-step="1">
                    <h2 class="text-xl font-semibold mb-4">A. GENERAL INFORMATION</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">1. Name *</label>
                            <input type="text" name="responses[name]" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">2. Permanent Address</label>
                            <input type="text" name="responses[permanent_address]" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">3. E-mail Address</label>
                            <input type="email" name="responses[email]" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">4. Telephone or Contact Number(s)</label>
                            <input type="text" name="responses[telephone]" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">5. Mobile Number</label>
                            <input type="text" name="responses[mobile]" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">6. Civil Status</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            <label class="flex items-center"><input type="radio" name="responses[civil_status]" value="Single" class="mr-2"> Single</label>
                            <label class="flex items-center"><input type="radio" name="responses[civil_status]" value="Married" class="mr-2"> Married</label>
                            <label class="flex items-center"><input type="radio" name="responses[civil_status]" value="Separated" class="mr-2"> Separated</label>
                            <label class="flex items-center"><input type="radio" name="responses[civil_status]" value="Single Parent" class="mr-2"> Single Parent</label>
                            <label class="flex items-center"><input type="radio" name="responses[civil_status]" value="Widow or Widower" class="mr-2"> Widow or Widower</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">7. Sex</label>
                        <div class="flex gap-4">
                            <label class="flex items-center"><input type="radio" name="responses[sex]" value="Male" class="mr-2"> Male</label>
                            <label class="flex items-center"><input type="radio" name="responses[sex]" value="Female" class="mr-2"> Female</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">8. Birthday</label>
                        <div class="flex gap-2">
                            <input type="text" name="responses[birthday_month]" placeholder="Month" class="w-20 border rounded px-3 py-2">
                            <input type="text" name="responses[birthday_day]" placeholder="Day" class="w-20 border rounded px-3 py-2">
                            <input type="text" name="responses[birthday_year]" placeholder="Year" class="w-20 border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">9. Region of Origin</label>
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2 text-sm">
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 1" class="mr-2"> Region 1</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 2" class="mr-2"> Region 2</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 3" class="mr-2"> Region 3</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 4" class="mr-2"> Region 4</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 5" class="mr-2"> Region 5</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 6" class="mr-2"> Region 6</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 7" class="mr-2"> Region 7</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 8" class="mr-2"> Region 8</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 9" class="mr-2"> Region 9</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 10" class="mr-2"> Region 10</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 11" class="mr-2"> Region 11</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="Region 12" class="mr-2"> Region 12</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="NCR" class="mr-2"> NCR</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="CAR" class="mr-2"> CAR</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="ARMM" class="mr-2"> ARMM</label>
                            <label class="flex items-center"><input type="radio" name="responses[region]" value="CARAGA" class="mr-2"> CARAGA</label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">10. Province</label>
                            <input type="text" name="responses[province]" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">11. Location of Residence</label>
                            <div class="flex gap-4">
                                <label class="flex items-center"><input type="radio" name="responses[residence_location]" value="City" class="mr-2"> City</label>
                                <label class="flex items-center"><input type="radio" name="responses[residence_location]" value="Municipality" class="mr-2"> Municipality</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: B. EDUCATIONAL BACKGROUND -->
                <div class="step hidden" data-step="2">
                    <h2 class="text-xl font-semibold mb-4">B. EDUCATIONAL BACKGROUND</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">12. Educational Attainment (Baccalaureate Degree only)</label>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-300 px-3 py-2 text-left">Degree(s) & Specialization(s)</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left">College or University</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left">Year Graduated</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left">Honor(s) or Award(s) Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[degree_1]" class="w-full border-0 focus:ring-0" placeholder="Enter degree">
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[college_1]" class="w-full border-0 focus:ring-0" placeholder="Enter college/university">
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[year_graduated_1]" class="w-full border-0 focus:ring-0" placeholder="Enter year">
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[honors_1]" class="w-full border-0 focus:ring-0" placeholder="Enter honors/awards">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: C. TRAINING(S)/ADVANCE STUDIES -->
                <div class="step hidden" data-step="3">
                    <h2 class="text-xl font-semibold mb-4">C. TRAINING(S)/ADVANCE STUDIES ATTENDED AFTER COLLEGE</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">15a. Please list down all professional or work-related training program(s) including advance studies you have attended after college.</label>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-300 px-3 py-2 text-left">Title of Training or Advance Study</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left">Duration and Credits Earned</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left">Name of Training Institution/College/University</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[training_title_1]" class="w-full border-0 focus:ring-0" placeholder="Enter training title">
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[training_duration_1]" class="w-full border-0 focus:ring-0" placeholder="Enter duration & credits">
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <input type="text" name="responses[training_institution_1]" class="w-full border-0 focus:ring-0" placeholder="Enter institution name">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: D. EMPLOYMENT DATA -->
                <div class="step hidden" data-step="4">
                    <h2 class="text-xl font-semibold mb-4">D. EMPLOYMENT DATA</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">16. Are you presently employed?</label>
                        <div class="space-y-2">
                            <label class="flex items-center"><input type="radio" name="responses[presently_employed]" value="Yes" class="mr-2"> Yes</label>
                            <label class="flex items-center"><input type="radio" name="responses[presently_employed]" value="No" class="mr-2"> No</label>
                            <label class="flex items-center"><input type="radio" name="responses[presently_employed]" value="Never Employed" class="mr-2"> Never Employed</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">19. Present occupation (Ex. Grade School Teacher, Electrical Engineer, Self-employed)</label>
                        <input type="text" name="responses[present_occupation]" class="w-full border rounded px-3 py-2" placeholder="Enter your present occupation">
                    </div>
                </div>

                <!-- STEP 5: E. OTHERS / FINAL -->
                <div class="step hidden" data-step="5">
                    <h2 class="text-xl font-semibold mb-4">E. ADDITIONAL INFORMATION</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">32. Was the curriculum you had in college relevant to your first job?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center"><input type="radio" name="responses[curriculum_relevant]" value="Yes" class="mr-2"> Yes</label>
                            <label class="flex items-center"><input type="radio" name="responses[curriculum_relevant]" value="No" class="mr-2"> No</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">34. List down suggestions to further improve your course curriculum</label>
                        <textarea name="responses[curriculum_suggestions]" class="w-full border rounded px-3 py-2" rows="4" placeholder="Enter your suggestions for curriculum improvement"></textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-8 flex items-center justify-between">
                    <button type="button" class="px-4 py-2 rounded bg-gray-200 text-gray-800" id="btn-prev">Back</button>
                    <div class="space-x-2">
                        <button type="button" class="px-4 py-2 rounded bg-blue-100 text-blue-700" id="btn-next">Next</button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 hidden cursor-pointer relative z-10" id="btn-submit" style="pointer-events: auto !important;">Submit Survey</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  console.log('Survey form JavaScript loaded');
  
  const steps = Array.from(document.querySelectorAll('.step'));
  let current = 0;
  const prev = document.getElementById('btn-prev');
  const next = document.getElementById('btn-next');
  const submit = document.getElementById('btn-submit');
  const pills = Array.from(document.querySelectorAll('[data-step-pill]'));
  const form = document.getElementById('gts-form');

  console.log('Found elements:', { steps: steps.length, prev, next, submit, pills: pills.length });
  
  // Debug submit button specifically
  if (submit) {
    console.log('Submit button found:', submit);
    console.log('Submit button classes:', submit.className);
    console.log('Submit button disabled:', submit.disabled);
  } else {
    console.error('Submit button NOT found!');
  }

  function render() {
    console.log('Rendering step:', current);
    steps.forEach((el, i) => el.classList.toggle('hidden', i !== current));
    // Manage required attributes so hidden steps don't block submit
    steps.forEach((el, i) => {
      const inputs = el.querySelectorAll('input, select, textarea');
      inputs.forEach((inp) => {
        const wasRequired = inp.getAttribute('data-was-required') === 'true';
        if (i === current) {
          // Restore required only if originally required
          if (wasRequired) inp.setAttribute('required', 'required');
        } else {
          // Remember if this field was required, then remove required to avoid HTML5 blocking
          if (inp.hasAttribute('required')) inp.setAttribute('data-was-required', 'true');
          if (!inp.hasAttribute('data-was-required')) inp.setAttribute('data-was-required', inp.hasAttribute('required') ? 'true' : 'false');
          inp.removeAttribute('required');
        }
      });
    });
    pills.forEach((el, i) => {
      el.classList.toggle('bg-blue-600', i === current);
      el.classList.toggle('text-white', i === current);
      el.classList.toggle('bg-gray-200', i !== current);
      el.classList.toggle('text-gray-700', i !== current);
    });
    if (prev) {
      prev.classList.remove('hidden');
      prev.disabled = current === 0;
      prev.classList.toggle('opacity-50', current === 0);
      prev.classList.toggle('cursor-not-allowed', current === 0);
    }
    if (next) next.classList.toggle('hidden', current === steps.length - 1);
    if (submit) submit.classList.toggle('hidden', current !== steps.length - 1);
  }

  if (prev) {
    prev.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Previous clicked, current:', current);
      if (current > 0) { 
        current--; 
        render(); 
      }
    });
  }

  if (next) {
    next.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Next clicked, current:', current);
      // Validate visible step before moving forward
      const currentStep = steps[current];
      const requiredInputs = currentStep.querySelectorAll('[required]');
      for (const inp of requiredInputs) {
        if (!inp.checkValidity()) {
          inp.reportValidity();
          return;
        }
      }
      if (current < steps.length - 1) {
        current++;
        render();
      }
    });
  }

  if (form) {
    form.addEventListener('submit', function(e) {
      // Re-enable required checks only for data that must be present, but avoid blocking due to hidden steps
      // Perform a final soft validation across all steps (optional)
      // Ensure all inputs are included in POST: do NOT disable fields; we only manipulated 'required'
      console.log('Submitting survey');
    });

    if (submit) {
      submit.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Submit button clicked - CLICK EVENT');
        
        // Validate all visible required fields
        const allInputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        allInputs.forEach(input => {
          if (!input.value.trim()) {
            isValid = false;
            input.reportValidity();
          }
        });
        
        if (isValid) {
          console.log('Form is valid, submitting...');
          // Don't remove required attributes, just submit normally
          form.submit();
        } else {
          console.log('Form validation failed');
        }
      });
    }
  }

  render();
});
</script>
@endpush
