@extends('layouts.auth')
@section('title', 'Consent Form')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-10  mx-auto  mt-5 ">
                <div class="card rounded-1 w-100">
                    <div class="card-header text-center bg-info-subtle">
                        <h4 class="card-title text-dark">Information Letter and Consent Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="justify-between">

                            <p>Dear Participate,
                                <br>
                                My name is Sahira Salam, and I am a master's student at DTU conducting an experiment as
                                part of my master's
                                thesis. You are invited to participate in a research study that explores how
                                inter-letter spacing and
                                inter-line spacing impact reading behavior. It is important that you read this
                                information letter carefully
                                and understand the terms before agreeing to participate. If you have any questions or
                                concerns regarding the
                                experiment, please feel free to contact me(Sahira Salam - s222499@dtu.dk) at any time.
                            </p>
                            <h6 class="fw-bolder">Your rights as Participant:</h6>
                            <p>Your participation in this study is completely voluntary. You have the right to:
                            </p>
                            <h6 class="fw-bolder">Purpose of the Study:</h6>
                            <p>This research is part of ‘Reading the Reader’ project. The purpose of this study is to
                                explore how text
                                formatting influences reading speed, reading comprehension, and eye movement patterns.
                                The findings may help
                                improve reading interfaces for digital platforms and enhance educational materials for
                                various readers</p>
                            <ul class="a">
                                <li>Decline to participate without facing any consequences.</li>
                                <li>Withdraw from the study at any time, even if you have already given your consent.
                                </li>
                            </ul>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="accept" id="accept" value="1" required
                                       onclick="toggleCheckbox('accept', 'decline')"
                                >
                                <label class="form-check-label" for="accept"> Accept </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="accept" id="decline" value="0"
                                       onclick="toggleCheckbox('decline', 'accept')"
                                >
                                <label class="form-check-label" for="decline"> Decline</label>
                            </div>


                            <br>


                            <div class="my-4 text-end">
                                <button type="button" class="btn  btn-primary" id="submitConsent">Next</button>
                            </div>
                            <p id="error-message" class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function toggleCheckbox(selectedId, otherId) {
            let selectedCheckbox = document.getElementById(selectedId);
            let otherCheckbox = document.getElementById(otherId);
            let nextButton = document.getElementById("submitConsent");

            if (selectedId === 'decline' && selectedCheckbox.checked) {
                nextButton.disabled = true;
            } else {
                nextButton.disabled = false;
            }

            if (selectedCheckbox.checked) {
                otherCheckbox.disabled = true;
            } else {
                otherCheckbox.disabled = false;
            }
        }

        document.getElementById("submitConsent").addEventListener("click", function () {
            let acceptCheckbox = document.getElementById("accept");
            let declineCheckbox = document.getElementById("decline");
            let errorMessage = document.getElementById("error-message");

            if (!acceptCheckbox.checked && !declineCheckbox.checked) {
                errorMessage.textContent = "Please select an option.";
                return;
            }

            let consentValue = acceptCheckbox.checked ? 1 : 0;

            fetch("{{ route('consent.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({accept: consentValue})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('dynamic.passage') }}";
                    } else {
                        errorMessage.textContent = data.message;

                    }
                })
                .catch(error => {
                    errorMessage.textContent = "Something went wrong. Please try again.";
                });
        });
    </script>
@endpush
