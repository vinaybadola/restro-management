<template>
    <div class="not-found">
        <h1 class="title">404</h1>
        <p class="message">Oops! Page not found.</p>
        <router-link to="/" class="button">Go back to Home</router-link>
    </div>
</template>

<script>
export default {
    name: 'NotFound',
};
</script>

<style>
.not-found {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f8f8f8;
}

.title {
    font-size: 6rem;
    color: #333;
    margin-bottom: 1rem;
    animation: fade-in 1s ease-in-out;
}

.message {
    font-size: 2rem;
    color: #666;
    margin-bottom: 2rem;
    animation: slide-up 1s ease-in-out;
}

.button {
    padding: 1rem 2rem;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 1.2rem;
    transition: background-color 0.3s ease-in-out;
}

.button:hover {
    background-color: #555;
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slide-up {
    from {
        transform: translateY(50px);
    }
    to {
        transform: translateY(0);
    }
}
</style>