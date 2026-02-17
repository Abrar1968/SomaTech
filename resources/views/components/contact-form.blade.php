@props(['services' => collect()])

<div x-data="contactForm()">
    {{-- Form State --}}
    <form
        @submit.prevent="submitForm"
        x-show="!success"
        class="space-y-6"
    >
        @csrf

        {{-- Name Field --}}
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Full Name *</label>
            <input
                type="text"
                id="name"
                x-model="form.name"
                @blur="validateField('name')"
                :class="errors.name ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                required
            />
            <p
                x-show="errors.name"
                x-text="errors.name"
                class="mt-2 text-sm text-[var(--color-error)] overflow-hidden transition-all"
                :class="errors.name ? 'max-h-20' : 'max-h-0'"
                role="alert"
            ></p>
        </div>

        {{-- Email Field --}}
        <div>
            <label for="email" class="block text-sm font-medium mb-2">Email Address *</label>
            <input
                type="email"
                id="email"
                x-model="form.email"
                @blur="validateField('email')"
                :class="errors.email ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                required
            />
            <p
                x-show="errors.email"
                x-text="errors.email"
                class="mt-2 text-sm text-[var(--color-error)] overflow-hidden transition-all"
                :class="errors.email ? 'max-h-20' : 'max-h-0'"
                role="alert"
            ></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Phone Field (Optional) --}}
            <div>
                <label for="phone" class="block text-sm font-medium mb-2">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    x-model="form.phone"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                />
            </div>

            {{-- Company Field (Optional) --}}
            <div>
                <label for="company" class="block text-sm font-medium mb-2">Company Name</label>
                <input
                    type="text"
                    id="company"
                    x-model="form.company"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Service Interest (Required) - SRS FR-022 --}}
            <div>
                <label for="service_interest" class="block text-sm font-medium mb-2">Service of Interest *</label>
                <select
                    id="service_interest"
                    x-model="form.service_interest"
                    @blur="validateField('service_interest')"
                    :class="errors.service_interest ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                    required
                >
                    <option value="">Select a service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->title }}">{{ $service->title }}</option>
                    @endforeach
                    <option value="Website Development">Website Development</option>
                    <option value="App Development">App Development</option>
                    <option value="Website Maintenance">Website Maintenance</option>
                    <option value="Other">Other</option>
                </select>
                <p
                    x-show="errors.service_interest"
                    x-text="errors.service_interest"
                    class="mt-2 text-sm text-[var(--color-error)]"
                    role="alert"
                ></p>
            </div>

            {{-- Budget Range (Optional) --}}
            <div>
                <label for="budget_range" class="block text-sm font-medium mb-2">Budget Range</label>
                <select
                    id="budget_range"
                    x-model="form.budget_range"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                >
                    <option value="">Prefer not to say</option>
                    <option value="< $5,000">< $5,000</option>
                    <option value="$5,000 - $10,000">$5,000 - $10,000</option>
                    <option value="$10,000 - $25,000">$10,000 - $25,000</option>
                    <option value="$25,000 - $50,000">$25,000 - $50,000</option>
                    <option value="$50,000+">$50,000+</option>
                </select>
            </div>
        </div>

        {{-- Message Field - SRS FR-022 (min 20 chars) --}}
        <div>
            <label for="message" class="block text-sm font-medium mb-2">Project Details *</label>
            <textarea
                id="message"
                x-model="form.message"
                @blur="validateField('message')"
                @input="updateCharCount"
                :class="errors.message ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors resize-none"
                rows="5"
                required
            ></textarea>
            <div class="flex justify-between mt-2">
                <p
                    x-show="errors.message"
                    x-text="errors.message"
                    class="text-sm text-[var(--color-error)]"
                    role="alert"
                ></p>
                <p
                    class="text-sm ml-auto"
                    :class="charCount < 20 ? 'text-[var(--color-error)]' : 'text-[var(--color-text-muted)]'"
                >
                    <span x-text="charCount"></span> / 20 characters minimum
                </p>
            </div>
        </div>

        {{-- Submit Button --}}
        <button
            type="submit"
            :disabled="loading"
            class="w-full px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
        >
            <span x-show="!loading">Send Message</span>
            <span x-show="loading" class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...
            </span>
        </button>
    </form>

    {{-- Success State - SRS FR-024 --}}
    <div
        x-show="success"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="text-center py-12"
    >
        {{-- Success Icon --}}
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[var(--color-success)]/20 flex items-center justify-center">
            <svg class="w-10 h-10 text-[var(--color-success)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h3 class="text-2xl font-semibold mb-3">Thank you<span x-show="form.name">, <span x-text="form.name"></span></span>!</h3>
        <p class="text-[var(--color-text-muted)] mb-6">We've received your message and will get back to you within 24 hours.</p>

        <button
            @click="reset"
            class="text-[var(--color-accent)] hover:underline"
        >
            Send another message
        </button>
    </div>

    {{-- Error Alert --}}
    <div
        x-show="globalError"
        x-transition
        class="fixed bottom-4 right-4 bg-[var(--color-error)] text-white px-6 py-4 rounded-lg shadow-lg z-50"
        role="alert"
    >
        <p x-text="globalError"></p>
    </div>
</div>

<script>
function contactForm() {
    return {
        form: {
            name: '',
            email: '',
            phone: '',
            company: '',
            service_interest: '',
            budget_range: '',
            message: ''
        },
        errors: {},
        loading: false,
        success: false,
        charCount: 0,
        globalError: '',

        validateField(field) {
            this.errors[field] = '';

            if (field === 'name' && !this.form.name) {
                this.errors.name = 'Please tell us your name.';
            }

            if (field === 'email') {
                if (!this.form.email) {
                    this.errors.email = 'We need your email to get back to you.';
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                    this.errors.email = 'Please provide a valid email address.';
                }
            }

            if (field === 'service_interest' && !this.form.service_interest) {
                this.errors.service_interest = 'Please select a service you\'re interested in.';
            }

            if (field === 'message') {
                if (!this.form.message) {
                    this.errors.message = 'Please share some details about your project.';
                } else if (this.form.message.length < 20) {
                    this.errors.message = 'Please provide at least 20 characters in your message.';
                }
            }
        },

        updateCharCount() {
            this.charCount = this.form.message.length;
        },

        async submitForm() {
            // Validate all required fields
            this.validateField('name');
            this.validateField('email');
            this.validateField('service_interest');
            this.validateField('message');

            // Check if there are any errors
            if (Object.values(this.errors).some(error => error !== '')) {
                return;
            }

            this.loading = true;
            this.globalError = '';

            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.form)
                });

                if (response.ok) {
                    this.success = true;
                } else if (response.status === 429) {
                    this.globalError = 'Too many requests. Please try again later.';
                } else {
                    const data = await response.json();
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            this.errors[key] = data.errors[key][0];
                        });
                    } else {
                        this.globalError = data.message || 'An error occurred. Please try again.';
                    }
                }
            } catch (error) {
                console.error('Form submission error:', error);
                this.globalError = 'An error occurred. Please try again.';
            } finally {
                this.loading = false;
                if (this.globalError) {
                    setTimeout(() => this.globalError = '', 5000);
                }
            }
        },

        reset() {
            this.form = {
                name: '',
                email: '',
                phone: '',
                company: '',
                service_interest: '',
                budget_range: '',
                message: ''
            };
            this.errors = {};
            this.success = false;
            this.charCount = 0;
        }
    };
}
</script>
