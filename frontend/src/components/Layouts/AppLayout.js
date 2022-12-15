import Sidebar from '@/components/Layouts/Sidebar'
import { useAuth } from '@/hooks/auth'
import Header from '@/components/Header'
import MobileBar from '@/components/MobileBar'

export default function AppLayout({ name, children }) {
    const { user } = useAuth({ middleware: 'auth' })

    return (
        <>
            {/* Page Heading */}
            <Header name={name} />

            {/* Page Content */}
            <main className="pt-16">
                <Sidebar user={user} />
                {children}
                <MobileBar />
            </main>
        </>
    )
}
