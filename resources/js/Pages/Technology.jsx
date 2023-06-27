import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import Navbar from './Navbar';


const Technology = ({ technologies }) => {
  return (
    <div>
      <Navbar />
      <h1>Medical Technologies</h1>
      <div className="technology-list">
        {technologies.map((technology, index) => (
          <React.Fragment key={index}>
            <div className="technology-item">
              <div className="technology-image">
                <img src={getImageURLs()[index]} alt={technology.name} />
              </div>
              <div className="technology-details">
                <h2>{technology.name}</h2>
                <p>{getTechnologyDescription(index)}</p>
              </div>
            </div>
            {index !== technologies.length - 1 && <div className="divider"></div>}
          </React.Fragment>
        ))}
      </div>
      <InertiaLink href="/">Go back to Home</InertiaLink>
      
    </div>
  );
};

const getImageURLs = () => {
  return [
    "https://www.proclinical.com/img/e0c5742e-2472-47a0-6ff9-08da2738e595",
    "https://www.proclinical.com/img/c93a3739-05e4-437c-6ffc-08da2738e595",
    "https://www.proclinical.com/img/10d71247-d685-44f6-6ffd-08da2738e595",
    "https://www.proclinical.com/img/fa3c10b2-8289-4696-235e-08da274e6e1d",
    "https://www.proclinical.com/img/8dec04c8-eabf-44e7-2360-08da274e6e1d",
    "https://www.proclinical.com/img/5290624e-7cc2-4c91-235d-08da274e6e1d",
    "https://www.proclinical.com/img/c66e8107-2ddb-4022-6ffa-08da2738e595",
    "https://www.proclinical.com/img/116d683a-700e-4c75-6ff8-08da2738e595",
    "https://www.proclinical.com/img/0865e3c6-8eda-46ec-6ffb-08da2738e595",
    "https://www.proclinical.com/img/e6a73183-9d10-468e-235f-08da274e6e1d"
  ];
};

const getTechnologyDescription = (index) => {
  const descriptions = [
    "mRNA technology has been put under the spotlight recently as the new vaccines for Covid-19 use this science. With their high effectiveness, capacity for rapid development, and potential for low production costs, mRNA vaccines offer an alternative to the traditional vaccine approach.",
    "Virtual reality has been around for some time. However, it is now being increasingly used to treat and manage a wide range of psychological illnesses and conditions, from stress and anxiety to dementia and autism. But its capabilities are not just limited to mental health conditions, it is also being used for effective pain management by changing the patients’ thoughts and perceptions around pain.",
    "Neurotechnology holds boundless potential to improve many aspects of life. It is already being practically applied in the medical and wellness industries, but also has many future implications for other contexts including education, workplace management, national security, and even sports.",
    "AI is proving to be very valuable when it comes to detecting diseases early and for confirming an accurate diagnosis quicker. For example, in breast cancer care, the use of AI is enabling the review of mammograms to be 30 times faster with 99% accuracy, reducing the need for unnecessary biopsies. AI is also being applied to oversee early-stage heart disease, allowing healthcare providers to discover potentially life-threatening problems at earlier and at more treatable stages. In addition, AI is also helping clinicians to create more comprehensive treatment programmes, allowing patients to manage their conditions more effectively.",
    "3D printers have quickly become one of the hottest technologies on the market. In healthcare, these game-changing printers can be used to create implants and even joints to be used during surgery. 3D-printed prosthetics are increasingly popular as they are entirely bespoke, with the digital functionalities enabling them to match an individual’s measurements down to the millimetre. The allows for unprecedently levels of comfort and mobility.",
    "As medical technology advances it is becoming more and more personalised to individual patients. Precision medicine considers the individual variability in genetics, environment, and lifestyle for each patient. For example, when using precision medicine to treat a patient with cancer, the medicine can be tailored to them based on their unique genetic make-up. This personalised medicine is far more effective than other types of treatment as it attacks tumours based on the patient’s genetics, causing gene mutations and making it more easily destroyed by the cancer medication.",
    "Clustered Regularly Interspaced Short Palindromic Repeats (CRISPR) is the most advanced gene-editing technology yet. It works by harnessing the natural mechanisms of the immune systems of bacterium cells of invading viruses, which is then able to ‘cut out’ infected DNA strands. This cutting of DNA is what has the power to potentially transform the way we treat disease. By modifying genes, some of the biggest threats to our health, like cancer and HIV, could potentially be overcome in a matter of years.",
    "Telehealth and telemedicine have become increasingly in demand since the Covid-19 pandemic began in 2020. Telemedicine refers specifically to remote clinical services, while telehealth encompasses remote non-clinical services. With more people adopting a new way of working and living since the pandemic, this is a trend which is likely to continue gaining momentum, with the global telemedicine market projected to grow from $68.36 billion to $218.49 billion by 2026.",
    "The demand for wearable devices has grown since their introduction in the past few years, since the release of Bluetooth in 2000. People today use wearables synced with their phone to track everything from their steps, physical fitness and heartbeat, to their sleeping patterns. With an aging population in much of the developed world, wearables can be effective at prevention of chronic conditions, such as diabetes and cardiovascular disease, by helping patients to monitor and improve their fitness.",
    "It is estimated, that by 2030, depression will be the leading cause of disease burden globally, making the need for new therapies more crucial than ever. Over the last year, many new technologies have emerged that can help address patients ongoing mental health needs."
  ];

  return descriptions[index];
};

export default Technology;
