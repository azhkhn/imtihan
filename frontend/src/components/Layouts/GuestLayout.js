import Head from 'next/head'

const GuestLayout = ({ children }) => {
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

export default GuestLayout
