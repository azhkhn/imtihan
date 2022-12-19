import Avatar from '@/components/Avatar'
import {ArrowLeftOnRectangleIcon} from '@heroicons/react/24/outline'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth'
import config from "@/config/menu";

export default function Sidebar(className) {
    const { logout } = useAuth()

    return (
        <nav
            className={`${className} top-0 pt-14 bg-gray-50 dark:bg-gray-900 rounded-lg drop-shadow-md sm:hidden md:hidden lg:block xl:block 2xl:block hidden overflow-auto w-72 h-screen`}>
            <Avatar />
            <ul className="text-lg">
                {
                    config.admin.map((item, index) => {
                        return (
                            <Link href={item.path} key={index}>
                                <li className="flex items-center p-5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                                    {item.icon}
                                    <label className="mx-2">{item.name}</label>
                                </li>
                            </Link>
                        )
                    })
                }
                <li
                    onClick={logout}
                    className="flex items-center p-5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                    <ArrowLeftOnRectangleIcon className="inline-block w-6 h-6" />{' '}
                    <label className="mx-2">Log out</label>
                </li>
            </ul>
        </nav>
    )
}
