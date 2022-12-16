import Head from 'next/head'

export default function GuestLayout({ children }) {
    return (
        <div>
            <Head>
                <title>Laravel</title>
            </Head>

            <main className="py-16 grid justify-items-center">
                {children}
            </main>
        </div>
    )
}
