# Hexadella Space

An ephemeral, zero-logs, in-memory anonymous ecosystem.

Hexadella Space is an experimental web platform designed with operational security (OpSec) and privacy as its core principles. Built on a modern Laravel stack utilizing real-time WebSockets, Hexadella serves as a stateless environment where conversations and interactions exist momentarily before vanishing.

## Architecture & Security

Hexadella is architected to leave zero digital footprints:

*   **Zero-Logs Policy:** The system actively purges data. Sensitive communications are strictly prevented from being written to disk or persisted in long-term storage.
*   **In-Memory WebSockets:** Powered by Laravel Reverb, the real-time communication system operates entirely in memory, broadcasting encrypted payloads instantaneously without database persistence.
*   **Infrastructure:** Designed to be deployed behind Cloudflare Proxy (Strict SSL mode) and an Nginx reverse proxy, effectively shielding the origin server from IP tracking and direct DDoS attacks.

## Core Services

### Whisperella
An ephemeral, real-time anonymous chat environment.
*   Driven by Laravel Reverb and Laravel Echo.
*   Messages are broadcasted in real-time and vanish immediately. There are no database models assigned to track chat history.
*   Utilizes a Glassmorphism UI for a clean, distraction-free aesthetic.

### Havenella
A secure, anonymous voting and discussion board.
*   Session-based anonymity for upvoting and downvoting mechanics.
*   Includes automated takedown sweeps (`php artisan sapu`) to aggressively purge controversial or targeted keywords from the database.

## Technical Stack

*   **Framework:** Laravel 11
*   **Real-time Engine:** Laravel Reverb (WebSockets)
*   **Frontend:** Livewire 3 + Alpine.js + Vanilla CSS (Glassmorphism UI)
*   **Build Tool:** Vite
*   **Server Environment:** Ubuntu + Nginx + PHP-FPM 8.2

## Local Development Setup

To run Hexadella locally for development or auditing purposes:

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/hexadella-space.git
   cd hexadella-space
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: You must set `REVERB_APP_ID`, `REVERB_APP_KEY`, and `REVERB_APP_SECRET` in your `.env` file for the WebSockets to function properly.*

4. Run the database migrations:
   ```bash
   php artisan migrate
   ```

5. Start the development servers (requires three terminal instances):
   ```bash
   # Terminal 1: Serve the application
   php artisan serve

   # Terminal 2: Start the Reverb WebSocket server
   php artisan reverb:start

   # Terminal 3: Compile frontend assets
   npm run dev
   ```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
