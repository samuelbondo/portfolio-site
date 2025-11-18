/**
 * Portfolio JavaScript - Optimized
 */

document.addEventListener('DOMContentLoaded', function() {

    // --- Mobile Navigation Toggle ---
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    if (hamburger) {
        hamburger.addEventListener('click', () => navMenu.classList.toggle('active'));
    }

    // --- Smooth Scrolling for Anchor Links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                navMenu.classList.remove('active'); // close mobile menu
            }
        });
    });

    // --- Active Navigation Link on Scroll ---
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    const highlightNav = () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.pageYOffset >= sectionTop - 200) current = section.getAttribute('id');
        });
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) link.classList.add('active');
        });
    };
    window.addEventListener('scroll', highlightNav);
    highlightNav();

    // --- Animate Skill Bars on Scroll ---
    const skillCards = document.querySelectorAll('.skill-card');
    skillCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
    });

    const animateSkills = () => {
        skillCards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            if (cardTop < window.innerHeight - 100) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
                const progress = card.querySelector('.skill-progress');
                if (progress) progress.style.width = progress.getAttribute('data-progress');
            }
        });
    };
    window.addEventListener('scroll', animateSkills);
    animateSkills();

    // --- Fade-in Sections ---
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -100px 0px' };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.section-title, .about-content, .project-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });

    // --- Contact Form Submission via AJAX ---
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateForm(contactForm)) return;

            const formData = new FormData(contactForm);
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            fetch('../contact.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    formMessage.textContent = data.message;
                    formMessage.className = 'form-message ' + (data.success ? 'success' : 'error');
                    if (data.success) contactForm.reset();
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    formMessage.style.display = 'block';
                    setTimeout(() => formMessage.style.display = 'none', 5000);
                })
                .catch(() => {
                    formMessage.textContent = 'An error occurred. Please try again.';
                    formMessage.className = 'form-message error';
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    formMessage.style.display = 'block';
                });
        });
    }

});

// --- Helper Functions ---
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validateForm(form) {
    const name = form.querySelector('#name').value.trim();
    const email = form.querySelector('#email').value.trim();
    const subject = form.querySelector('#subject').value.trim();
    const message = form.querySelector('#message').value.trim();

    if (!name || !email || !subject || !message) {
        alert('Please fill in all fields');
        return false;
    }
    if (!validateEmail(email)) {
        alert('Please enter a valid email address');
        return false;
    }
    return true;
}
