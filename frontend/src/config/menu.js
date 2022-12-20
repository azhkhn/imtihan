import {BriefcaseIcon, HomeIcon} from "@heroicons/react/24/outline";

const config = {
    admin: [
        {
            name: 'Home',
            icon: <HomeIcon className="inline-block w-6 h-6"/>,
            path: "/dashboard"
        },
        {
            name: 'Companies',
            icon: <BriefcaseIcon className="inline-block w-6 h-6"/>,
            path: "/admin/company"
        },
    ],
    manager: [],
    teacher: [],
    student: [],

};

export default config;
