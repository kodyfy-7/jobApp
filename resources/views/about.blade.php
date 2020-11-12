@extends('layouts.app')

@section('title')
    About App
@endsection

@section('content')
<section class="py-5">
    <div class="container py-5">
      <div class="row text-center">
        <div class="col-lg-10 mx-auto">
          <div class="card border-0 shadow">
            <div class="card-body p-5">
              <div class="row">
                <div class="col-lg-12 mb-4 mb-lg-0">
                      <svg class="svg-icon mb-3 text-primary svg-icon-big">
                        <use xlink:href="#list-details-1"> </use>
                      </svg>
                  <h2 class="h5">About JobApp</h2>
                  <p class="text-muted text-small mb-0">JobApp aims to bridge the gap between companies and propective employees. It offers a platform wher companies can post job ads upon registration such that the ads become avialable for prospects to apply. Prospects are also required to have an account with JobApp before being able to apply.</p>
                  <p class="text-muted text-small mb-0">After a prospect applies for a job, a resume; submitted the registration or chosen by the prospect, is send to the respective owner of the job ad for review.</p>
                  <br><br>
                  <h2 class="h5">Demo Accounts</h2>
                  <p class="text-muted text-small mb-0">
                    Company account - Email address: client@client.com | Password: password
                  </p>
                  <p class="text-muted text-small mb-0">
                    Prospect account - Email address: user@user.com | Password: password
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
    


