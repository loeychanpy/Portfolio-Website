<section class="contact-section">
    <div class="container-lg py-5">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Let's Work Together</h2>
            <p class="section-subtitle">Have a project in mind? Get in touch!</p>
            <div class="section-divider mx-auto"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <form id="contact-form" class="contact-form">
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="john@example.com" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="6" placeholder="Your message here..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
                </form>
                
                <div id="form-message" class="alert alert-success mt-4 d-none fade-in" role="alert">
                    <strong>Thank you!</strong> Your message has been sent successfully. I'll get back to you soon.
                </div>
            </div>
        </div>
    </div>
</section>