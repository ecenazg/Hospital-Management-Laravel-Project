import React from 'react';

const Contact = () => {
  return (
    <div className="container mx-auto py-8">
      <h1 className="text-4xl font-bold mb-6">Contact Us</h1>

      <div className="grid grid-cols-2 gap-8">
        <div>
          <h2 className="text-2xl font-bold mb-4">Address</h2>
          <p className="mb-2">ECE Hospital</p>
          <p className="mb-2">1234 Example Street</p>
          <p className="mb-2">City, State, Country</p>
        </div>

        <div>
          <h2 className="text-2xl font-bold mb-4">Contact Information</h2>
          <p className="mb-2">Phone: +1234567890</p>
          <p className="mb-2">Email: info@ece.com.tr</p>
        </div>
      </div>

      <div className="mt-8">
        <h2 className="text-2xl font-bold mb-4">Send us a message</h2>
        <form>
          <div className="mb-4">
            <label htmlFor="name" className="block font-medium mb-1">Name</label>
            <input type="text" id="name" className="border border-gray-300 rounded-md px-4 py-2 w-full" />
          </div>

          <div className="mb-4">
            <label htmlFor="email" className="block font-medium mb-1">Email</label>
            <input type="email" id="email" className="border border-gray-300 rounded-md px-4 py-2 w-full" />
          </div>

          <div className="mb-4">
            <label htmlFor="message" className="block font-medium mb-1">Message</label>
            <textarea id="message" rows="6" className="border border-gray-300 rounded-md px-4 py-2 w-full"></textarea>
          </div>

          <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Send Message</button>
        </form>
      </div>
    </div>
  );
};

export default Contact;
