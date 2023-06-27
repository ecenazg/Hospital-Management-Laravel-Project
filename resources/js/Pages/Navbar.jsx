import React from 'react';

const NavBar = () => {
    return (
        <header className="bg-white shadow">
            <div className="container mx-auto px-6 py-3">
                <div className="flex items-center justify-between">
                    <div className="hidden w-full text-gray-600 md:flex md:items-center">
                        <svg
                            className="h-5 w-5 mr-1"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 19V5M19 12l-7-7-7 7M5 19h14"
                                stroke="currentColor"
                                strokeWidth="2"
                                fill="none"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            />
                        </svg>
                        <span>Back to Homepage</span>
                    </div>
                    <div className="w-full text-gray-700 md:text-center text-2xl font-semibold flex justify-center">
                        <img
                            src="https://marketplace.canva.com/EAE8eSD-Zyo/1/0/1600w/canva-blue%2C-white-and-green-medical-care-logo-oz1ox2GedbU.jpg"
                            alt="Logo"
                            style={{ maxWidth: "150px", maxHeight: "100px" }}
                        />
                    </div>
                    <div className="flex items-center justify-end w-full">
                        <button className="text-gray-600 focus:outline-none mx-4 sm:mx-0">
                            <svg
                                className="h-6 w-6"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M22 12h-4l-3 9L9 3l-3 9H2"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    fill="none"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                />
                            </svg>
                        </button>

                        <div className="flex sm:hidden">
                            <button
                                type="button"
                                className="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                                aria-label="toggle menu"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    className="h-6 w-6 fill-current"
                                >
                                    <path
                                        fillRule="evenodd"
                                        d="M3 5h18a1 1 0 110 2H3a1 1 0 110-2zm0 6h18a1 1 0 110 2H3a1 1 0 010-2zm0 6h18a1 1 0 110 2H3a1 1 0 010-2z"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <nav className="sm:flex sm:justify-center sm:items-center mt-4">
                    <div className="flex flex-col sm:flex-row">
                        <a
                            href="/"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Home
                        </a>
                        <a
                            href="/technologies"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Technologies
                        </a>
                        <a
                            href="/services"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Services
                        </a>
                        <a
                            href="/contact"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Contact
                        </a>

                        <a
                            href="/departments"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Departments
                        </a>
                        <a
                            href="/appointments"
                            className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                        >
                            Appointments
                        </a>
                    </div>
                </nav>
            </div>
        </header>
    );
};

export default NavBar;