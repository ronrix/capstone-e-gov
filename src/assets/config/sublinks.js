import { fetchData } from "../../utils/axios-instance";

export const government = [
  { link: '/government/news', title: 'news', desc: 'Current news happening around pililla' },
  {
    link: '/government/programs-events',
    title: 'programs and events',
    desc: 'Updated programs and events in pililla'
  },
  { link: '/government/job-op', title: 'job opportunities', desc: 'Looking for opportunities' },
  {
    link: '/government/demographic-profile',
    title: 'demographic profile',
    desc: 'You can see the population growth in pillla'
  },
  {
    link: '/government/current-officials',
    title: 'Current Officials',
    desc: 'View the current officials of the municipality'
  },
  {
    link: '/government/former-officials',
    title: 'Former Officials',
    desc: 'View the former officials of the municipality'
  },
  { link: '/government/emergency-hotlines', title: 'emergency hotlines', desc: 'Call for help/inquiries' },
  {
    link: '/government/full-disclosure-report',
    title: 'full disclosure reports',
    desc: 'Transparency for disclosing of the budget of pililla'
  },
  {
    link: '/government/official-seal',
    title: 'Official Seal',
    desc: 'Photographs and symbolisms of component of pililla logo'
  },
  {
    link: '/government/municipal-ordinances',
    title: 'municipal ordinances',
    desc: 'The Municipal ordinances of Pililla Rizal'
  }
]

export const tourism = [
  {
    link: '/tourism/tourist-attractions',
    title: 'tourist attractions',
    desc: 'You can here all the tourists spots in pilila'
  },
  {
    link: '/tourism/festivals',
    title: 'festivals',
    desc: 'Highlights of the festivals in pililla and its history'
  }
]

export let services = []

export const business = [
  {
    link: '/business/business-establishment',
    title: 'business establishments',
    desc: 'Acknowledge the busines establishments in pillla'
  },
  { link: '/business/apartments', title: 'apartments', desc: 'Looking for nice apartment?' },
  { link: '/business/business-permit-and-licensing-office', title: 'Business Permit and Licensing Office', desc: 'Get business permit and licensing office requirements' }
]

export const about = [
  { link: '/about/contacts', title: 'Contacts', desc: 'More about contact information of Pililla Rizal' },
  { link: '/about/history', title: 'History', desc: 'Read the history of pililla' },
  { link: '/about/mission-and-vision', title: 'Mission and Vision', desc: 'Our mission and vision' },
  { link: '/about/FAQ', title: 'FAQs', desc: 'Frequently Asked Questions' },
]

fetchData("/service-types").then(data => {
  localStorage.setItem("services", JSON.stringify(data.service_types))
  const mergedServices = Object.values(data.service_types).flat() // merged all array values into one
  services = mergedServices.map(a => {
    return {
      link: "/services/" + a.replace(" ", "_"),
      title: a,
      desc: "Service"
    }
  })
}).catch(err => console.log(err))