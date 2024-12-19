import { BrowserRouter, Routes, Route } from "react-router-dom";
import LoginPage from './pages/Login';
import RegisterPage from './pages/Register';

export function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/login" element={<LoginPage />} />
                <Route path="/register" element={<RegisterPage />} />
                <Route path="/about" element={<About />} />
                <Route
                    path="*"
                    element={
                        <main style={{ padding: "1rem" }}>
                            <p>There's nothing here!</p>
                        </main>
                    }
                />
            </Routes>
        </BrowserRouter>
    );
}

function Home() {
    return <h1>Hello, Next.js!</h1>;
}

function About() {
    return <h1>About</h1>;
}


export default App;
