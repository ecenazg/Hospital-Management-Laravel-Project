import React, { useState } from "react";
import { Slide } from "react-slideshow-image";
import Patients from "./Patients";

const Menu = () => {
    return (
        <ul className="menu bg-base-200 w-56 rounded-box">
            <li>
                <a href="/doctors">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                    Doctors
                </a>
            </li>
            <li>
                <a href="/nurses">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    Nurses
                </a>
            </li>
            <li>
                <a href="/patients">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        />
                    </svg>
                    Patients
                </a>
            </li>
            <li>
                <a href="/management">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        />
                    </svg>
                    Management
                </a>
            </li>
            <li>
                <a
                    href="/laboratory"
                    className="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        />
                    </svg>
                    Laboratory
                </a>
            </li>
        </ul>
    );
};

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

const images = [
    "https://img-guven.mncdn.com/storage/temp/public/imageresizecache/2ec/a8f/39e/2eca8f39e051d67aef0a2e10352b5342c094e9610988de715755f5ba002e0e4f.jpg",
    "https://img-guven.mncdn.com/storage/temp/public/imageresizecache/b63/38f/b39/b6338fb390a4dd882d6557c016d32c42991b7fc97ae596a89367f34c48bbfb53.jpg",
];

const Index = () => {
    const [currentPage, setCurrentPage] = useState(0);

    const handleNextPage = () => {
        setCurrentPage((prevPage) => (prevPage + 1) % images.length);
    };

    const handlePrevPage = () => {
        setCurrentPage(
            (prevPage) => (prevPage - 1 + images.length) % images.length
        );
    };

    return (
        <div className="flex">
            <Menu />

            <div className="flex-grow">
                <NavBar />

                <h1 className="text-4xl font-bold mt-8">
                    Welcome to ECE's Hospital
                </h1>
                <div className="content">
                    <div className="slideshow">
                        <img
                            src={images[currentPage]}
                            alt={`Slide ${currentPage + 1}`}
                            className="slide-image"
                        />
                        <div className="pagination">
                            <button
                                onClick={handlePrevPage}
                                disabled={currentPage === 0}
                                className="pagination-button"
                            >
                                Prev
                            </button>
                            <button
                                onClick={handleNextPage}
                                disabled={currentPage === images.length - 1}
                                className="pagination-button"
                            >
                                Next
                            </button>
                        </div>
                        <div className="page-indicator">
                            Page {currentPage + 1} of {images.length}
                        </div>
                    </div>
                    <h2 className="text-2xl font-semibold mt-6">
                        The #1 Hospital Service in Ankara
                    </h2>
                </div>
            </div>
        </div>
    );
};

export default Index;
