import ReactDOM from 'react-dom/client';
import React from 'react';
import App from './app';

const root = ReactDOM.createRoot(document.getElementById('app') as HTMLElement);

root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
