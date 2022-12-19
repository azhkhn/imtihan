import AppLayout from '@/components/Layouts/AppLayout'
import Head from 'next/head'
import Link from "next/link";
import NavLink from "@/components/NavLink";
import { ChevronRightIcon } from "@heroicons/react/24/outline";

Dashboard.getLayout = (page) => <AppLayout name="Dashboard">{page}</AppLayout>
export default function Dashboard() {
    return (
        <>
            <Head>
                <title>İmtihan</title>
                <meta
                    name="description"
                    content="Generated by codenteq"
                />
                <link rel="icon" href="/favicon.ico" />
            </Head>

            <main className="px-4 pt-16">
                <div className="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
                    <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-5">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <Link href="/admin/company">
                                    <a className="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">134</a>
                                </Link>
                                <h3 className="text-base font-normal text-gray-500">New companies this week</h3>
                            </div>
                            <div className="flex flex-1 justify-end text-green-500 font-bold">
                                14.6%
                            </div>
                        </div>
                    </div>
                    <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-5">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <Link href="/admin/company">
                                    <a className="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">260</a>
                                </Link>
                                <h3 className="text-base font-normal text-gray-500">New managers this week</h3>
                            </div>
                            <div className="flex flex-1 justify-end text-green-500 font-bold">
                                18.1%
                            </div>
                        </div>
                    </div>
                    <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-5">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <Link href="/admin/company">
                                    <a className="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">134</a>
                                </Link>
                                <h3 className="text-base font-normal text-gray-500">New users this week</h3>
                            </div>
                            <div className="flex flex-1 justify-end text-red-500 font-bold">
                                3.4%
                            </div>
                        </div>
                    </div>

                </div>

                <div className="mt-4 w-full">
                    <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                        <div className="flex items-center justify-between mb-4">
                            <div className="flex-shrink-0">
                                <span
                                    className="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">$2678</span>
                                <h3 className="text-base font-normal text-gray-500">Sales this week</h3>
                            </div>
                            <div className="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                12.5%
                            </div>
                        </div>
                        <div className="p-4 sm:p-6 xl:p-8 ">
                            <div className="mb-4 flex items-center justify-between">
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">Latest Transactions</h3>
                                    <span className="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                                </div>
                                <div className="flex-shrink-0">
                                    <div className="flex-shrink-0">
                                        <NavLink href="/admin/company" name="View all" className="p-1 px-3"/>
                                    </div>
                                </div>
                            </div>

                            <div className="flex flex-col mt-8">
                                <Link href="">
                                    <div className="flex items-center border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 overflow-hidden rounded-lg w-full h-full p-2">
                                        <div className="inline-flex flex-col w-full">
                                            <span className="text-blue">Company name</span>
                                            <span className="text-gray-500">19 December 2022</span>
                                        </div>
                                        <label className="bg-red-800 text-white rounded-lg text-xs font-medium p-1 mr-10">waiting</label>
                                        <ChevronRightIcon className="text-blue w-8 h-8"/>
                                    </div>
                                </Link>
                                <Link href="">
                                    <div className="flex items-center border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 overflow-hidden rounded-lg w-full h-full p-2">
                                        <div className="inline-flex flex-col w-full">
                                            <span className="text-blue">Company name</span>
                                            <span className="text-gray-500">17 December 2022</span>
                                        </div>
                                        <label className="bg-green-800 text-white rounded-lg text-xs font-medium p-1 mr-10">paid</label>
                                        <ChevronRightIcon className="text-blue w-8 h-8"/>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </>
    )
}
