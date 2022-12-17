import { HomeIcon } from "@heroicons/react/24/outline";

const config = {
    admin: [],
    manager: [],
    teacher: [],
    student: [
        {
            name: 'Home',
            icon: <HomeIcon className="inline-block w-6 h-6"/>,
            path: "/"
        },
    ],

};

export default config;
