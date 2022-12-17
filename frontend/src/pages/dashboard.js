import AppLayout from '@/components/Layouts/AppLayout'
import Head from 'next/head'
import Index from "@/pages/admin/company";

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

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
