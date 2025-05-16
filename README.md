# BeatLink - Inertia.js & Tailwind Learning Project

This project was created as a learning exercise to explore and test Inertia.js and Tailwind CSS integration with Laravel. It is not intended for production use.

***This project was done during my free time in less than a week***

## Learning Goals

- Test and understand Inertia.js integration with Laravel
- Explore Tailwind CSS for styling
- Practice modern full-stack development patterns
- Learn how to structure a Laravel + Inertia application
- Stripe integration with subscriptions
- Experiment different UI libraries
- Experiment CI/CD tools like Laravel Vapor, AWS, GPC with Kaniko cache

## Project Scope

This is a test project that includes common web application features to demonstrate the capabilities of Inertia.js and Tailwind:

- Basic authentication
- Form handling
- API integration examples
- Campaign management interface
- Subscription flow (for testing purposes only)

## Technical Stack

- Laravel
- Inertia.js
- Tailwind CSS
- TypeScript
- Vite

## Installation

```bash
composer install &&
npm install &&
php artisan storage:link
```

## Development

Start the development servers:

```bash
# Start Vite development server
npm run dev

# Start Laravel development server
./vendor/bin/sail up -d
```

## Note

This project is for learning and testing purposes only. It is not intended for production use and may contain simplified implementations of features that would require more robust handling in a production environment.

## What I Learned

- How to set up and configure Inertia.js with Laravel
- Implementing Tailwind CSS in a Laravel application
- Handling state management between frontend and backend
- Structuring a modern full-stack application
- Working with TypeScript in a Laravel context

## Future Improvements

If this were a production project, I would:
- Add comprehensive testing
- Implement more robust error handling
- Add proper documentation
- Enhance security measures
- Optimize performance

But since this is a learning project, the focus was on understanding and implementing the core technologies rather than production-grade features.