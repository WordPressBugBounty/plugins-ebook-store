<?php // Tailwind CDN for modern styling
echo '<script src="https://cdn.tailwindcss.com"></script>';
?>
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h3 class="text-3xl font-bold text-gray-900 mb-4">Simple, Transparent Pricing</h3>
        <p class="text-lg text-gray-600">Choose the perfect plan for your business needs with our professional eBook selling solutions.</p>
        <p class="text-sm text-gray-500 mt-2">All plans include a <span class="font-semibold">one-time payment</span> and come with <span class="font-semibold">2 years of technical support</span>.</p>
    </div>

    <!-- Pricing Cards Container -->
    <div class="grid md:grid-cols-3 gap-8 items-start">
        <!-- Free Plan -->
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-100 transition-all duration-200 hover:shadow-xl">
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Free</h3>
                <div class="flex items-baseline mb-8">
                    <span class="text-4xl font-extrabold text-gray-900">$0</span>
                    <span class="text-gray-500 ml-1">/forever</span>
                </div>

                <!-- Feature Groups -->
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Core Features</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Basic PayPal Integration</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Email Delivery</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Protected Download Links</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-8 bg-gray-50 rounded-b-2xl">
                <button class="w-full py-3 px-6 rounded-xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-colors">
                    Start Free
                </button>
            </div>
        </div>

        <!-- Pro Plan -->
        <div class="relative bg-white rounded-2xl shadow-xl border-2 border-blue-500 transition-all duration-200 hover:shadow-2xl transform md:-translate-y-4">
            <div class="absolute -top-5 left-0 right-0 mx-auto w-32 rounded-full bg-blue-500 text-white text-sm font-semibold py-1 text-center">
                MOST POPULAR
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">Pro</h3>
                <div class="flex items-baseline mb-8">
                    <span class="text-4xl font-extrabold text-gray-900">$49</span>
                    <span class="text-gray-500 ml-1">/one-time</span>
                </div>

                <!-- Feature Groups -->
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Everything in Free, plus:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/stripe.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">All Payment Gateways</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/mc_script_black_web.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">MailChimp Integration</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/woocommerce-logo-min.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">WooCommerce Integration</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/affiliate-manager-header-logo.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Affiliate Manager</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">PDF Encryption & Watermarking</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">QR Code Protection</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Free & Paid Downloads</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Donate to Download Option</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Auto Account Creation</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Unlimited Sites License</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-8 bg-gray-50 rounded-b-2xl">
                <a href="https://www.shopfiles.com/index.php/products/wordpress-ebook-store#pricing" target="_blank" 
                   class="block w-full py-3 px-6 rounded-xl bg-blue-600 text-white font-semibold text-center hover:bg-blue-700 transition-colors">
                    Get Started
                </a>
            </div>
        </div>

        <!-- Full Site Setup -->
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-100 transition-all duration-200 hover:shadow-xl">
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Full Site Setup</h3>
                <div class="flex items-baseline mb-8">
                    <span class="text-4xl font-extrabold text-gray-900">$1,999</span>
                    <span class="text-gray-500 ml-1">/one-time</span>
                </div>

                <!-- Feature Groups -->
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Complete Solution Including:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Custom Store Development</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">Complete WordPress Setup</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">60 Days VIP Support</span>
                            </li>
                            <li class="flex items-center">
                                <img height="16" width="16" src="<?php echo plugins_url('/img/checked.png', __FILE__); ?>" class="mr-3" />
                                <span class="text-gray-600">1-on-1 Training Sessions</span>
        </li>
      </ul>
    </div>
  </div>
</div>
            <div class="p-8 bg-gray-50 rounded-b-2xl">
                <a href="https://www.shopfiles.com/index.php/products/wordpress-ebook-store#pricing" target="_blank" 
                   class="block w-full py-3 px-6 rounded-xl bg-gray-900 text-white font-semibold text-center hover:bg-gray-800 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom CTA -->
    <div class="text-center mt-12">
        <p class="text-gray-600 mb-4">Not sure which plan is right for you?</p>
        <a href="https://www.shopfiles.com/index.php/contact" target="_blank" 
           class="inline-block py-2 px-6 text-blue-600 font-medium hover:text-blue-700 transition-colors">
            Contact our team for a personalized recommendation →
        </a>
    </div>
</div>

<!-- Video Tutorials Section -->
<div class="max-w-7xl mx-auto px-4 py-12 mt-8 border-t border-gray-100">
    <div class="text-center mb-12">
        <h3 class="text-3xl font-bold text-gray-900 mb-4">Video Tutorials</h3>
        <p class="text-lg text-gray-600">Learn how to use every feature with our detailed video guides</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Payment Methods -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">Payment Integration</h3>
            </div>
            <p class="text-gray-600 mb-4">Learn how to set up Stripe and PayPal payment gateways</p>
            <a href="https://youtu.be/jWbQtHqc3Lo" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- WooCommerce Integration -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">WooCommerce Integration</h3>
            </div>
            <p class="text-gray-600 mb-4">Set up and configure WooCommerce with your ebook store</p>
            <a href="https://www.youtube.com/watch?v=kaEKQ0yTaWA" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- PDF Protection -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">PDF Protection</h3>
            </div>
            <p class="text-gray-600 mb-4">Learn about PDF encryption and watermarking features</p>
            <a href="https://youtu.be/KfVWPZ3eKcc" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Free Downloads -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">Free Downloads</h3>
            </div>
            <p class="text-gray-600 mb-4">Configure and manage free download options</p>
            <a href="https://youtu.be/l0gGYNtNENc" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Read on Site -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">Read on Site</h3>
            </div>
            <p class="text-gray-600 mb-4">Set up the PDF reader for on-site viewing</p>
            <a href="https://youtu.be/ZLePB91b96M" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Auto Account Creation -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">Auto Account Creation</h3>
            </div>
            <p class="text-gray-600 mb-4">Learn about automatic user account creation</p>
            <a href="https://youtu.be/HK7xxaBDtHY" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Download Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start mb-4">
                <img height="24" width="24" src="<?php echo plugins_url('/img/yt.png', __FILE__); ?>" class="mr-3" alt="YouTube" />
                <h3 class="text-lg font-semibold text-gray-900">Download Forms</h3>
            </div>
            <p class="text-gray-600 mb-4">Set up forms for download requests</p>
            <a href="https://youtu.be/YLPNTKAgoLY" target="_blank" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700">
                Watch tutorial
                <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>