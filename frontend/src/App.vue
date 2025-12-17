<template>
  <main class="app">
    <header class="header">
      <h1>🐾 Pet Sitting App</h1>
      <p class="subtitle">Manage pets easily</p>
    </header>

    <section class="content">
      <router-view />
    </section>
  </main>
</template>

<style>
:root {
  --primary: #4f46e5;
  --primary-dark: #4338ca;
  --danger: #dc2626;
  --bg: #f4f6fb;
  --card: #ffffff;
  --text: #1f2937;
  --muted: #6b7280;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
  background-color: var(--bg);
  color: var(--text);
}

.app {
  min-height: 100vh;
}

.header {
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  color: white;
  padding: 2.5rem;
}

.header h1 {
  margin: 0;
  font-size: 2.2rem;
}

.subtitle {
  margin-top: 0.5rem;
  opacity: 0.9;
}

.content {
  max-width: 1000px;
  margin: -2rem auto 0;
  padding: 2rem;
}
</style>
